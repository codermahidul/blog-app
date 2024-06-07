@extends('admin.layouts.navbar')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="active">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                    <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li>
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="components-article.html">Article</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-avatar.html">Avatar</a></li>
                    <li><a class="nav-link" href="components-chat-box.html">Chat Box</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-empty-state.html">Empty State</a></li>
                    <li><a class="nav-link" href="components-gallery.html">Gallery</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-hero.html">Hero</a></li>
                    <li><a class="nav-link" href="components-multiple-upload.html">Multiple Upload</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-pricing.html">Pricing</a></li>
                    <li><a class="nav-link" href="components-statistic.html">Statistic</a></li>
                    <li><a class="nav-link" href="components-tab.html">Tab</a></li>
                    <li><a class="nav-link" href="components-table.html">Table</a></li>
                    <li><a class="nav-link" href="components-user.html">User</a></li>
                    <li><a class="nav-link beep beep-sidebar" href="components-wizard.html">Wizard</a></li>
                </ul>
            </li>

        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
