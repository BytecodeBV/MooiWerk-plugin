<?php
/*
 * Check if field  group exists
 */
function is_field_group_exists($value, $type = 'post_title') {
    $exists = false;
    if ($field_groups = get_posts(['post_type' => 'acf-field-group'])) {
        foreach ($field_groups as $field_group) {
            if ($field_group->$type == $value) {
                $exists = true;
            }
        }
    }
    return $exists;
}

/*
 * Output pagination for posts and users.
 */
function numeric_pagination($current_page, $num_pages) {
    echo '<nav class="d-flex justify-content-center vacancy-list__pagination custom-pagination">' .
    '<ul class="pagination pagination-sm custom-pagination__list">';
    $start_number = $current_page - 2;
    $end_number = $current_page + 2;

    if (($start_number - 1) < 1) {
        $start_number = 1;
        $end_number = min($num_pages, $start_number + 4);
    }

    if (($end_number + 1) > $num_pages) {
        $end_number = $num_pages;
        $start_number = max(1, $num_pages - 4);
    }

    if ($start_number > 1) {
        echo '<li class="page-item custom-pagination__item"><span class="page-link custom-pagination__link"> 1 </span></li><li>...</li>';
    }

    for ($i = $start_number; $i <= $end_number; $i++) {
        $page_url = get_pagenum_link($i);
        if ($i === $current_page) {
            echo '<li class="page-item active custom-pagination__item"><a href="' . $page_url . '" class="page-link custom-pagination__link">';
            echo " [{$i}] ";
            echo '</a></li>';
        } else {
            echo '<li class="page-item custom-pagination__item"><a href="' . $page_url . '" class="page-link custom-pagination__link">';
            echo " {$i} ";
            echo '</a></li>';
        }
    }

    if ($end_number < $num_pages) {
        echo '<li>...</li><li class="page-item custom-pagination__item"><span class="page-link custom-pagination__link"> ' . $num_pages . ' </span></li>';
    }
    echo '</ul></nav>';
}

/**
 * Add key, value pair to the post meta filters if it is set.
 */
function add_to_meta_query_if_get_exists($filter_key, $filter_value, &$query) {
    if (isset($filter_value)) {
        foreach ($filter_value as $value) {
            $meta_addition = [
                'key' => rawurldecode($filter_key),
                'value' => rawurldecode($value),
                'compare' => 'LIKE'
            ];
            array_push($query, $meta_addition);
        }
    }
}

/**
 * Add key, value pair OR to the post meta filters if it is set.
 */
function add_to_meta_query_if_get_exists_or($filter_key, $filter_value, &$query) {
    $nested_meta = ['relation' => 'OR'];
    if (isset($filter_value)) {
        foreach ($filter_value as $value) {
            $meta_addition = [
                'key' => rawurldecode($filter_key),
                'value' => rawurldecode($value),
                'compare' => 'LIKE'
            ];
            array_push($nested_meta, $meta_addition);
        }
    }
    array_push($query, $nested_meta);
}

/**
 * Function add_to_meta_query_if_get_exists rewrite in pure form.
 */
function get_query_meta_from_value($filter_key, $filter_value, $or = false) {
    if (is_string($filter_value)) {
        $values_to_search = explode(',', $filter_value);
        if (length($values_to_search) == 1) {
            return [
                'key' => rawurldecode($filter_key),
                'value' => rawurldecode($values_to_search),
                'compare' => 'LIKE'
            ];
        } else {
            $meta_list = [];
            if ($or) {
                $meta_list[] = ['relation' => 'OR'];
            }
            foreach ($values_to_search as $value) {
                $meta = [
                    'key' => rawurldecode($filter_key),
                    'value' => rawurldecode($value),
                    'compare' => 'LIKE'
                ];
                array_push($meta_list, $meta);
            }
            return $meta_list;
        }
    }
    return [];
}

/**
 * Script to add filter variables to the url and refresh.
 * Originally taken from ACF documentation.
 */
function filter_script($page) {
    ?>

<script type="text/javascript">
(function($) {
    // change
    $('#archive-filters').on('change', 'input[type="checkbox"],input[type="radio"],select', function(){
        // vars
        var url = '<?php echo home_url($page); ?>';
            args = {};
        // loop over filters
        $('#archive-filters .filter').each(function(){
            // vars
            var filter = $(this).data('filter'),
                vals = [];
            // find checked inputs
            $(this).find('input:checked, option:selected').each(function(){
                if( $(this).val()  !== '*'){
                    vals.push( $(this).val() );
                }                
            });
            // append to args
            args[ filter ] = vals.join('_');
        });
        // update url
        url += '?';
        // loop over args
        $.each(args, function( name, value ){
            if(value !== ""){
                url += name + '=' + value + '&';
            }
        });
        // remove last &
        url = url.slice(0, -1);
        // reload page
        window.location.replace( url );
    });
})(jQuery);
</script>

    <?php
}

//compare dates
function isExpired($time) {
    return (time() > strtotime($time));
}

//get user role
function get_current_user_role() {
    if (is_user_logged_in()) {
        $user = wp_get_current_user();
        $role = ( array ) $user->roles;
        return $role[0];
    } else {
        return false;
    }
}

//get available tickes
function get_available_event_tickets($event_id) {
    $timestamp = get_post_meta($event_id, '_wcs_timestamp', true);
    $woo_booking_capacity = get_post_meta($event_id, WCS_PREFIX . '_woo_capacity', true);
    $woo_booking_label = get_post_meta($event_id, WCS_PREFIX . '_woo_label', true);
    $woo_booking_product = get_post_meta($event_id, WCS_PREFIX . '_woo_product', true);
    $woo_booking_history = get_post_meta($event_id, '_' . WCS_PREFIX . '_woo_history', true);
    if (empty($woo_booking_label) || empty($woo_booking_capacity) || empty($woo_booking_product) || intval($woo_booking_capacity) <= 0) {
        return false;
    }

    $product = wc_get_product($woo_booking_product);

    if (!is_object($product)) {
        return false;
    }

    if (!$product->is_purchasable()) {
        return false;
    }

    $total = 0;

    if (!empty($woo_booking_history)) {
        $history = maybe_unserialize($woo_booking_history);
        if (isset($history[$timestamp])) {
            //assumes only a tickey can be purchased by aan attendee
            $total = count($history[$timestamp]);
        }
    }
    return $woo_booking_capacity - $total;
}
