<?php 
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {
private $menuClass 						 = 'nav__list';
private $menuItemClass 				    = 'nav__item';
private $menuLinkClass 				 = 'nav__link';

function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array( $this->submenuClass );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
}
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // Depth-dependent classes.
    $depth_classes = array(
        ( $depth == 0 ? $this->menuItemClass : $this->submenuItemClass ),
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $myClasses = array();

    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $myClasses ), $item ) ) );

    // Build HTML.
    $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

    // Link attributes.
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="'.$this->menuLinkClass.'"';

    // Build HTML output and pass through the proper filter.
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

class About_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $menuClass 						 = 'list__apropos';
    private $menuItemClass 				    = 'footer__item';
    private $menuLinkClass 				 = 'footer__link';

function start_lvl( &$output, $depth = 0, $args = array() ) {
            // Depth-dependent classes.
            $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
            $display_depth = ( $depth + 1); // because it counts the first submenu as 0
            $classes = array( $this->submenuClass );
            $class_names = implode( ' ', $classes );
    
            // Build HTML for output.
            $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
    
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? $this->menuItemClass : $this->submenuItemClass ),
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
    
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $myClasses = array();
    
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $myClasses ), $item ) ) );
    
        // Build HTML.
        $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';
    
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="'.$this->menuLinkClass.'"';
    
        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class Tv_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $menuClass 						 = 'list__tv';
    private $menuItemClass 				    = 'footer__item';
    private $menuLinkClass 				 = 'footer__link';
    
function start_lvl( &$output, $depth = 0, $args = array() ) {
    // Depth-dependent classes.
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array( $this->submenuClass );
    $class_names = implode( ' ', $classes );
        
    // Build HTML for output.
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        
    // Depth-dependent classes.
    $depth_classes = array(
        ( $depth == 0 ? $this->menuItemClass : $this->submenuItemClass ),
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        
    // Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $myClasses = array();
        
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $myClasses ), $item ) ) );
        
    // Build HTML.
    $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';
        
    // Link attributes.
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="'.$this->menuLinkClass.'"';
        
    // Build HTML output and pass through the proper filter.
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class Partner_Walker_Nav_Menu extends Walker_Nav_Menu {
    private $menuClass 						 = 'list__partenaire';
    private $menuItemClass 				    = 'footer__item';
    private $menuLinkClass 				 = 'footer__link';
    
function start_lvl( &$output, $depth = 0, $args = array() ) {
    // Depth-dependent classes.
    $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
    $display_depth = ( $depth + 1); // because it counts the first submenu as 0
    $classes = array( $this->submenuClass );
    $class_names = implode( ' ', $classes );
        
    // Build HTML for output.
    $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }
function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
        
    // Depth-dependent classes.
    $depth_classes = array(
        ( $depth == 0 ? $this->menuItemClass : $this->submenuItemClass ),
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
        
    // Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $myClasses = array();
        
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $myClasses ), $item ) ) );
        
    // Build HTML.
    $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';
        
    // Link attributes.
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="'.$this->menuLinkClass.'"';
        
    // Build HTML output and pass through the proper filter.
    $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
        $args->before,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after
    );
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}