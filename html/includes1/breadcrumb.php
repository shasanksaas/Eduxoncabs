<?php
// Breadcrumb generation function
function generateBreadcrumb($current_page = 'Home', $current_url = '/') {
    $home_url = 'https://www.eduxoncabs.com/';
    
    echo '<nav aria-label="Breadcrumb" class="breadcrumb-nav">';
    echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList" class="breadcrumb">';
    
    // Home breadcrumb
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item">';
    echo '<a itemprop="item" href="' . $home_url . '">';
    echo '<span itemprop="name">Home</span>';
    echo '</a>';
    echo '<meta itemprop="position" content="1" />';
    echo '</li>';
    
    // Current page breadcrumb (if not home)
    if ($current_page !== 'Home') {
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item active" aria-current="page">';
        echo '<span itemprop="name">' . $current_page . '</span>';
        echo '<meta itemprop="position" content="2" />';
        echo '</li>';
    }
    
    echo '</ol>';
    echo '</nav>';
}
?>

<style>
.breadcrumb-nav {
    background: #f8f9fa;
    padding: 10px 0;
    margin-bottom: 20px;
}

.breadcrumb {
    margin: 0;
    padding: 8px 15px;
    background: transparent;
    border-radius: 0;
}

.breadcrumb-item {
    font-size: 14px;
}

.breadcrumb-item a {
    color: #007bff;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    color: #0056b3;
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #6c757d;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: "›";
    color: #6c757d;
    margin: 0 8px;
}
</style>
