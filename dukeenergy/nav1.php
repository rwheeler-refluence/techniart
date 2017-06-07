<nav class="navbar navbar-default main-nav" role="navigation" aria-label="Primary Navigation">
    <div class="container">
        <div class="row">
            <!--starts Hamburger Icon-->
            <div class="col-xs-1 col-sm-1 visible-xs visible-sm navbar-side hamburger-navbar">
                <div class="hamburger-container" ng-class="{'active': openMobile}" ng-click="showMobile()">
                    <div class="hamburger-top"></div>
                    <div class="hamburger-bottom"></div>
                </div>
            </div>
            <!--ends Hamburger Icon-->
            <div class="col-xs-1 col-sm-2 visible-sm visible-xs logo-container">
                <a href="/" class="duke-logo" title="Duke Energy">
                        <img src="https://www.duke-energy.com/_/media/images/common/logoduke.png" alt="Duke Energy" class="duke-logo-img" />
                </a>
            </div>
            <!--starts Menu Items-->
            <div class="hidden-sm hidden-xs col-md-7 col-lg-7">
                <div class="nav-container-left">
                    <div class="state-container">
                        <a role="button" tabindex="1" data-category="primary_navigation" ng-navhelper="state-list-desktop" data-label="Select Your State" data-action="{{relativeURL}}" class="ci-icon-location state-select dropdown-state" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ng-class="{'active': stateContainer, 'intercept-active':interceptVisible}" ng-enterclick ng-click="showStates()">Select Your State</a>
                    </div>
                    <ul class="nav navbar-nav">
                            <li  class="active">
                                <a tabindex="0" href="https://www.duke-energy.com/home">For Your Home</a>

                            </li>
                            <li >
                                <a tabindex="0" href="https://www.duke-energy.com/business">For Your Business</a>

                            </li>
                            <li >
                                <a tabindex="0" href="https://www.duke-energy.com/our-company">Our Company</a>

                            </li>
                            <li >
                                <a tabindex="0" href="https://www.duke-energy.com/partner-with-us">Partner With Us</a>

                            </li>
                    </ul>
                </div>
            </div>
            <!--ends Menu Items-->
            <!--starts extra Menu Items-->
<div class="col-xs-2 col-sm-9 col-md-5 col-lg-5 navbar-side" ng-class="{'opacity':openMobile}">
    <div class="nav-container-right pull-right">
        <ul class="nav navbar-nav">
            <li>
<a href='/outages' class='outages ci-icon-safety' tabindex='0' >                    <span class="inner-text">Outages</span>
</a>            </li>
            <li>
<a href='/customer-service' class='customer-service' tabindex='0' >                    <span class="glyphicon glyphicon-earphone icon-customer-service" aria-hidden="true"></span>
                    <span class="inner-text">Customer Service</span>
</a>            </li>
            <li class="sign-in-button" ng-init="init();" ng-mouseover="showDropdownNav($event)" ng-mouseleave="hideDropdownNav($event)" ng-click="goToSignIn($event)" data-href="https://www.duke-energy.com/sign-in" ng-keydown="toggleDropdown($event)">
                <a tabindex="0" data-category="{{loggedIn ? '' : 'primary_navigation'}}" data-label="{{loggedIn ? '' : 'My Account'}}" data-action="{{loggedIn ? '' : 'Login'}}" class=" signin ci-icon-person hidden-xs hidden-sm"><span class="inner-text">My Account</span></a>
                <a tabindex="0" data-category="{{loggedIn ? '' : 'primary_navigation'}}" data-label="{{loggedIn ? '' : 'My Account'}}" data-action="{{loggedIn ? '' : 'Login'}}" class=" signin ci-icon-person visible-xs visible-sm"><span class="inner-text">My Account</span></a>
                
                <ul class="dropdown-menu">
                            <li><a href='/sign-in' data-category='sign_in' ng-click='event.stopPropagation();' tabindex='0' data-label='My account' data-action='My Account Home' >My Account Home</a></li>
                            <li><a href='/sign-in' data-category='sign_in' ng-click='event.stopPropagation();' tabindex='0' data-label='My account' data-action='Sign Out' >Sign Out</a></li>
                </ul>
            </li>
            <li><a tabindex="0" role="button" class="search ci-icon-search" ng-click="showSearch()" ng-class="{true: 'active'} [openSearch]" title="Search Bar Toggle" ng-buttondown="showSearch()"></a></li>
        </ul>
    </div>
</div>
<!--ends extra Menu Items-->
        </div>
    </div>
</nav>
