<!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <!-- LOGO -->
        <div class="navbar-brand-box">
            <a href="{{route('Admin.dashboard')}}" class="logo logo-dark">
                <span class="logo-sm">
                    <img src="assets/images/logo-dark-sm.png" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="assets/images/logo-dark.png" alt="" height="22">
                </span>
            </a>

            <a href="{{route('Admin.dashboard')}}" class="logo logo-light">
                <span class="logo-lg">
                    <img src="{{url('admin/assets/images/logo-light.png')}}" alt="" height="22">
                </span>
                <span class="logo-sm">
                    <img src="assets/images/logo-light-sm.png" alt="" height="22">
                </span>
            </a>
        </div>

        <button type="button" class="btn btn-sm px-3 header-item vertical-menu-btn topnav-hamburger">
            <span class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </button>

        <div data-simplebar class="sidebar-menu-scroll">

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu">Menu</li>

                    <li>
                        <a href="{{route("Admin.dashboard")}}">
                            <i class="icon nav-icon" data-eva="grid-outline"></i>
                            <span class="menu-item" data-key="t-dashboards">Dashboards</span>
                            {{-- <span class="badge rounded-pill bg-primary">3</span> --}}
                        </a>
                        {{-- <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route("Admin.dashboard")}}" data-key="t-ecommerce">Ecommerce</a></li>
                            <li><a href="dashboard-saas.html" data-key="t-saas">Saas</a></li>
                            <li><a href="dashboard-crypto.html" data-key="t-crypto">Crypto</a></li>
                        </ul> --}}
                    </li>

                    <li class="menu-title" data-key="t-applications">Applications</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="briefcase-outline"></i>
                            <span class="menu-item" data-key="t-projects">Jobs Manager</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('Admin.CreateJob')}}" data-key="t-p-grid">Create Job</a></li>
                            <li><a href="{{route('Admin.JobList')}}" data-key="t-p-grid">All Jobs</a></li>
                            <li><a href="{{route('Admin.ShowVerifiedJobs')}}" data-key="t-p-grid">Verified Jobs</a></li>
                            <li><a href="{{route('Admin.ShowRejectedJobs')}}" data-key="t-p-grid">Rejected Jobs</a></li>
                            <li><a href="{{route('Admin.ShowPendingJobs')}}" data-key="t-p-grid">Pending Jobs</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="briefcase-outline"></i>
                            <span class="menu-item" data-key="t-projects">Jobs Attributes</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('Admin.JobSkill')}}" data-key="t-p-grid">Jobs Skill</a></li>
                            <li><a href="{{route('Admin.JobCategory')}}" data-key="t-p-list">Jobs Category</a></li>
                            <li><a href="{{route('Admin.JobDepartment')}}" data-key="t-p-grid">Jobs Department</a></li>
                            <li><a href="{{route('Admin.JobRole')}}" data-key="t-p-grid">Jobs Role</a></li>
                            <li><a href="{{route('Admin.JobLocation')}}" data-key="t-p-grid">Jobs Location</a></li>
                            <li><a href="{{route('Admin.JobTypes')}}" data-key="t-p-list">Jobs Types</a></li>
                            <li><a href="{{route('Admin.JobMode')}}" data-key="t-p-list">Jobs Mode</a></li>
                            <li><a href="{{route('Admin.JobShift')}}" data-key="t-p-list">Jobs Shift</a></li>
                            <li><a href="{{route('Admin.JobExperience')}}" data-key="t-p-list">Jobs Experience</a></li>
                            <li><a href="{{route('Admin.JobCurrency')}}" data-key="t-p-list">Jobs Currency</a></li>
                            <li><a href="{{route('Admin.JobSalary')}}" data-key="t-p-list">Jobs Salary</a></li>
                            <li><a href="{{route('Admin.JobIntType')}}" data-key="t-p-list">Jobs Interview Type</a></li>
                            <li><a href="{{route('Admin.JobEducation')}}" data-key="t-p-list">Jobs Qualification</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('Admin.Companies')}}">
                            <i class="far fa-building"></i>
                            <span class="menu-item" data-key="t-projects">Companies</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('Admin.Recruiters')}}">
                            <i class="far fas fa-user-tie"></i>
                            <span class="menu-item" data-key="t-projects">Recruiters</span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{route('Admin.UserList')}}">
                            <i class="far fas fa-user-tie"></i>
                            <span class="menu-item" data-key="t-projects">Users List</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('Admin.AllApplicants')}}">
                            <i class="far fas fa-user-tie"></i>
                            <span class="menu-item" data-key="t-projects">All Applicants</span>
                        </a>
                    </li> --}}

                     <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="settings-outline"></i>
                            <span class="menu-item" data-key="t-projects">Candidate DataBase</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('Admin.UserList')}}" data-key="t-p-grid">Users List</a></li>
                            <li><a href="{{route('Admin.AllApplicants')}}" data-key="t-p-grid">All Applicants</a></li>
                            {{-- <li><a href="{{route('Admin.PageSettings')}}" data-key="t-p-grid">Custom Pages</a></li>
                            <li><a href="#" data-key="t-p-grid">Widgets</a></li>
                            <li><a href="#" data-key="t-p-grid">Custom CSS</a></li>
                            <li><a href="#" data-key="t-p-grid">Custom Js</a></li>
                            <li><a href="#" data-key="t-p-grid">Themes</a></li>
                            <li><a href="#" data-key="t-p-grid">Header</a></li>
                            <li><a href="{{route('Admin.Footer')}}" data-key="t-p-grid">Footer</a></li> --}}
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-applications">Apperiance</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="settings-outline"></i>
                            <span class="menu-item" data-key="t-projects">Appereance</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('Admin.menu')}}" data-key="t-p-grid">Menus</a></li>
                            <li><a href="{{route('Admin.FrontPageSettings')}}" data-key="t-p-grid">Front Page Settings</a></li>
                            <li><a href="{{route('Admin.PageSettings')}}" data-key="t-p-grid">Custom Pages</a></li>
                            <li><a href="#" data-key="t-p-grid">Widgets</a></li>
                            <li><a href="#" data-key="t-p-grid">Custom CSS</a></li>
                            <li><a href="#" data-key="t-p-grid">Custom Js</a></li>
                            <li><a href="#" data-key="t-p-grid">Themes</a></li>
                            <li><a href="#" data-key="t-p-grid">Header</a></li>
                            <li><a href="{{route('Admin.Footer')}}" data-key="t-p-grid">Footer</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-applications">Settings</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="settings-outline"></i>
                            <span class="menu-item" data-key="t-projects">Settings</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{route('Admin.GeneralSetting')}}" data-key="t-p-grid">General Setting</a></li>
                            <li><a href="{{route('Admin.EmailSetting')}}" data-key="t-p-grid">Email Setting</a></li>
                            <li><a href="{{route('Admin.EmailTemplates')}}" data-key="t-p-grid">Email Templates</a></li>
                            <li><a href="#" data-key="t-p-grid">Site Setting</a></li>
                            <li><a href="#" data-key="t-p-grid">Language</a></li>
                            <li><a href="#" data-key="t-p-grid">Cache</a></li>
                            <li><a href="{{route('Admin.Database')}}" data-key="t-p-grid">Import/Export</a></li>
                            <li><a href="#" data-key="t-p-grid">Website Tracking</a></li>
                            <li><a href="#" data-key="t-p-grid">SEO</a></li>
                            <li><a href="{{route('Admin.Maintenance')}}" data-key="t-p-grid">Maintanence Mode</a></li>
                        </ul>
                    </li>

                    {{-- <li>
                        <a href="apps-calendar.html">
                            <i class="icon nav-icon" data-eva="calendar-outline"></i>
                            <span class="menu-item" data-key="t-calendar">Calendar</span>
                        </a>
                    </li>

                    <li>
                        <a href="apps-chat.html">
                            <i class="icon nav-icon" data-eva="message-circle-outline"></i>
                            <span class="menu-item" data-key="t-chat">Chat</span>
                            <span class="badge rounded-pill  bg-danger-subtle  text-danger " data-key="t-hot">Hot</span>
                        </a>
                    </li>

                    <li>
                        <a href="apps-file-manager.html">
                            <i class="icon nav-icon" data-eva="archive-outline"></i>
                            <span class="menu-item" data-key="t-filemanager">File Manager</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="shopping-bag-outline"></i>
                            <span class="menu-item" data-key="t-ecommerce">Ecommerce</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="ecommerce-products.html" data-key="t-products">Products</a></li>
                            <li><a href="ecommerce-product-detail.html" data-key="t-product-detail">Product Detail</a></li>
                            <li><a href="ecommerce-orders.html" data-key="t-orders">Orders</a></li>
                            <li><a href="ecommerce-customers.html" data-key="t-customers">Customers</a></li>
                            <li><a href="ecommerce-cart.html" data-key="t-cart">Cart</a></li>
                            <li><a href="ecommerce-checkout.html" data-key="t-checkout">Checkout</a></li>
                            <li><a href="ecommerce-shops.html" data-key="t-shops">Shops</a></li>
                            <li><a href="ecommerce-add-product.html" data-key="t-add-product">Add Product</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="email-outline"></i>
                            <span class="menu-item" data-key="t-email">Email</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="email-inbox.html" data-key="t-inbox">Inbox</a></li>
                            <li><a href="email-read.html" data-key="t-read-email">Read Email</a></li>
                            <li>
                                <a href="javascript: void(0);">
                                    <span data-key="t-email-templates">Templates</span>
                                    <span class="badge rounded-pill bg-success-subtle text-success" data-key="t-new">New</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="email-template-basic.html" data-key="t-basic-action">Basic Action</a></li>
                                    <li><a href="email-template-alert.html" data-key="t-alert-email">Alert Email</a></li>
                                    <li><a href="email-template-billing.html" data-key="t-bill-email">Billing Email</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="book-outline"></i>
                            <span class="menu-item" data-key="t-invoices">Invoices</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="invoices-list.html" data-key="t-invoice-list">Invoice List</a></li>
                            <li><a href="invoices-detail.html" data-key="t-invoice-detail">Invoice Detail</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="briefcase-outline"></i>
                            <span class="menu-item" data-key="t-projects">Projects</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="projects-grid.html" data-key="t-p-grid">Projects Grid</a></li>
                            <li><a href="projects-list.html" data-key="t-p-list">Projects List</a></li>
                            <li><a href="projects-create.html" data-key="t-create-new">Create New</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="wifi-outline"></i>
                            <span class="menu-item" data-key="t-contacts">Contacts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="contacts-grid.html" data-key="t-user-grid">User Grid</a></li>
                            <li><a href="contacts-list.html" data-key="t-user-list">User List</a></li>
                            <li><a href="contacts-profile.html" data-key="t-user-profile">Profile</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-layouts">Layouts</li>
        
                    <li>
                        <a href="layouts-horizontal.html">
                            <i class="icon nav-icon" data-eva="browser-outline"></i>
                            <span class="menu-item" data-key="t-horizontal">Horizontal</span>
                        </a>
                    </li>

                    <li class="menu-title" data-key="t-pages">Pages</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="icon nav-icon" data-eva="person-done-outline"></i>
                            <span class="menu-item" data-key="t-authentication">Authentication</span>
                            <span class="badge rounded-pill bg-info">8</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="auth-login.html" data-key="t-login">Login</a></li>
                            <li><a href="auth-register.html" data-key="t-register">Register</a></li>
                            <li><a href="auth-recoverpw.html" data-key="t-recover-password">Recover Password</a></li>
                            <li><a href="auth-lock-screen.html" data-key="t-lock-screen">Lock Screen</a></li>
                            <li><a href="auth-logout.html" data-key="t-logout">Logout</a></li>
                            <li><a href="auth-confirm-mail.html" data-key="t-confirm-mail">Confirm Mail</a></li>
                            <li><a href="auth-email-verification.html" data-key="t-email-verification">Email Verification</a></li>
                            <li><a href="auth-two-step-verification.html" data-key="t-two-step-verification">Two Step Verification</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="cube-outline"></i>
                            <span class="menu-item" data-key="t-utility">Utility</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="pages-starter.html" data-key="t-starter-page">Starter Page</a></li>
                            <li><a href="pages-maintenance.html" data-key="t-maintenance">Maintenance</a></li>
                            <li><a href="pages-comingsoon.html" data-key="t-coming-soon">Coming Soon</a></li>
                            <li><a href="pages-timeline.html" data-key="t-timeline">Timeline</a></li>
                            <li><a href="pages-faqs.html" data-key="t-faqs">FAQs</a></li>
                            <li><a href="pages-pricing.html" data-key="t-pricing">Pricing</a></li>
                            <li><a href="pages-404.html" data-key="t-error-404">Error 404</a></li>
                            <li><a href="pages-500.html" data-key="t-error-500">Error 500</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-components">Components</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="layers-outline"></i>
                            <span class="menu-item" data-key="t-ui-elements">UI Elements</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="ui-alerts.html" data-key="t-alerts">Alerts</a></li>
                            <li><a href="ui-buttons.html" data-key="t-buttons">Buttons</a></li>
                            <li><a href="ui-cards.html" data-key="t-cards">Cards</a></li>
                            <li><a href="ui-carousel.html" data-key="t-carousel">Carousel</a></li>
                            <li><a href="ui-dropdowns.html" data-key="t-dropdowns">Dropdowns</a></li>
                            <li><a href="ui-grid.html" data-key="t-grid">Grid</a></li>
                            <li><a href="ui-images.html" data-key="t-images">Images</a></li>
                            <li><a href="ui-lightbox.html" data-key="t-lightbox">Lightbox</a></li>
                            <li><a href="ui-modals.html" data-key="t-modals">Modals</a></li>
                            <li><a href="ui-offcanvas.html" data-key="t-offcanvas">Offcanvas</a></li>
                            <li><a href="ui-rangeslider.html" data-key="t-range-slider">Range Slider</a></li>
                            <li><a href="ui-progressbars.html" data-key="t-progress-bars">Progress Bars</a></li>
                            <li><a href="ui-sweet-alert.html" data-key="t-sweet-alert">Sweet-Alert</a></li>
                            <li><a href="ui-tabs-accordions.html" data-key="t-tabs-accordions">Tabs & Accordions</a></li>
                            <li><a href="ui-typography.html" data-key="t-typography">Typography</a></li>
                            <li><a href="ui-video.html" data-key="t-video">Video</a></li>
                            <li><a href="ui-general.html" data-key="t-general">General</a></li>
                            <li><a href="ui-colors.html" data-key="t-colors">Colors</a></li>
                            <li><a href="ui-rating.html" data-key="t-rating">Rating</a></li>
                            <li><a href="ui-notifications.html" data-key="t-notifications">Notifications</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="edit-2-outline"></i>
                            <span class="menu-item" data-key="t-forms">Forms</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="form-elements.html" data-key="t-form-elements">Form Elements</a></li>
                            <li><a href="form-layouts.html" data-key="t-form-layouts">Form Layouts</a></li>
                            <li><a href="form-validation.html" data-key="t-form-validation">Form Validation</a></li>
                            <li><a href="form-advanced.html" data-key="t-form-advanced">Form Advanced</a></li>
                            <li><a href="form-editors.html" data-key="t-form-editors">Form Editors</a></li>
                            <li><a href="form-uploads.html" data-key="t-form-upload">Form File Upload</a></li>
                            <li><a href="form-wizard.html" data-key="t-form-wizard">Form Wizard</a></li>
                            <li><a href="form-mask.html" data-key="t-form-mask">Form Mask</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="list"></i>
                            <span class="menu-item" data-key="t-tables">Tables</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="tables-basic.html" data-key="t-basic-tables">Basic Tables</a></li>
                            <li><a href="tables-advanced.html" data-key="t-advanced-tables">Advance Tables</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="pie-chart-outline"></i>
                            <span class="menu-item" data-key="t-charts">Charts</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="javascript: void(0);" class="has-arrow" data-key="t-apex-charts">Apex Charts</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="charts-line.html" data-key="t-line">Line</a></li>
                                    <li><a href="charts-area.html" data-key="t-area">Area</a></li>
                                    <li><a href="charts-column.html" data-key="t-column">Column</a></li>
                                    <li><a href="charts-bar.html" data-key="t-bar">Bar</a></li>
                                    <li><a href="charts-mixed.html" data-key="t-mixed">Mixed</a></li>
                                    <li><a href="charts-timeline.html" data-key="t-timeline">Timeline</a></li>
                                    <li><a href="charts-candlestick.html" data-key="t-candlestick">Candlestick</a></li>
                                    <li><a href="charts-boxplot.html" data-key="t-boxplot">Boxplot</a></li>
                                    <li><a href="charts-bubble.html" data-key="t-bubble">Bubble</a></li>
                                    <li><a href="charts-scatter.html" data-key="t-scatter">Scatter</a></li>
                                    <li><a href="charts-heatmap.html" data-key="t-heatmap">Heatmap</a></li>
                                    <li><a href="charts-treemap.html" data-key="t-treemap">Treemap</a></li>
                                    <li><a href="charts-pie.html" data-key="t-pie">Pie</a></li>
                                    <li><a href="charts-radialbar.html" data-key="t-radialbar">Radialbar</a></li>
                                    <li><a href="charts-radar.html" data-key="t-radar">Radar</a></li>
                                    <li><a href="charts-polararea.html" data-key="t-polararea">Polararea</a></li>
                                </ul>
                            </li>
                            <li><a href="charts-echart.html" data-key="t-e-charts">E Charts</a></li>
                            <li><a href="charts-chartjs.html" data-key="t-chartjs-charts">Chartjs Charts</a></li>
                            <li><a href="charts-tui.html" data-key="t-ui-charts">Toast UI Charts</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="smiling-face-outline"></i>
                            <span class="menu-item" data-key="t-icons">Icons</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="icons-evaicons.html" data-key="t-evaicons">Eva Icons</a></li>
                            <li><a href="icons-boxicons.html" data-key="t-boxicons">Boxicons</a></li>
                            <li><a href="icons-materialdesign.html" data-key="t-material-design">Material Design</a></li>
                            <li><a href="icons-fontawesome.html" data-key="t-font-awesome">Font Awesome 5</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="pin-outline"></i>
                            <span class="menu-item" data-key="t-maps">Maps</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="maps-google.html" data-key="t-google">Google</a></li>
                            <li><a href="maps-vector.html" data-key="t-vector">Vector</a></li>
                            <li><a href="maps-leaflet.html" data-key="t-leaflet">Leaflet</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="icon nav-icon" data-eva="share-outline"></i>
                            <span class="menu-item" data-key="t-multi-level">Multi Level</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li><a href="javascript: void(0);" data-key="t-level-1.1">Level 1.1</a></li>
                            <li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2">Level 1.2</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="javascript: void(0);" data-key="t-level-2.1">Level 2.1</a></li>
                                    <li><a href="javascript: void(0);" data-key="t-level-2.2">Level 2.2</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> --}}

                </ul>
            </div>
            <!-- Sidebar -->

            <div class="p-3 px-4 sidebar-footer">
                <p class="mb-1 main-title"><script>document.write(new Date().getFullYear())</script> &copy; CareerNest</p>
                <p class="mb-0">Design & Develop by Dazzler Software</p>
            </div>
        </div>
    </div>


    <!-- if i not using this sidebar dropdown menu is not working  -->
    <header class="ishorizontal-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{route('Admin.dashboard')}}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{url('admin/assets/images/logo-dark-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{url('admin/assets/images/logo-dark.png')}}" alt="" height="22">
                        </span>
                    </a>

                    <a href="{{route('Admin.dashboard')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url('admin/assets/images/logo-light-sm.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="{{url('admin/assets/images/logo-light.png')}}" alt="" height="22">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div class="d-none d-sm-block ms-2 align-self-center">
                    <h4 class="page-title">Dashboard</h4>
                </div>
            </div>

            <div class="d-flex">
                <div class="dropdown">
                    <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-sm" data-eva="search-outline"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                        <form class="p-2">
                            <div class="search-box">
                                <div class="position-relative">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Search...">
                                    <i class="search-icon" data-eva="search-outline" data-eva-height="26" data-eva-width="26"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="dropdown d-inline-block language-switch">
                    <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="header-lang-img" src="assets/images/flags/us.jpg" alt="Header Language" height="16">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                            <img src="assets/images/flags/us.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                            <img src="assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                            <img src="assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                            <img src="assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                            <img src="assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                        </a>
                    </div>
                </div>

                <div class="dropdown d-none d-lg-inline-block">
                    <button type="button" class="btn header-item noti-icon" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-sm" data-eva="grid-outline"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="m-0 font-size-15"> Web Apps </h5>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small fw-semibold text-decoration-underline"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="px-lg-2 pb-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/github.png" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="assets/images/brands/slack.png" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-sm" data-eva="bell-outline"></i>
                        <span class="noti-dot bg-danger rounded-pill">4</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5 class="m-0 font-size-15"> Notifications </h5>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small fw-semibold text-decoration-underline"> Mark all as read</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 250px;">
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="assets/images/users/avatar-3.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">James Lemire</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">It will seem like simplified English.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-sm me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your order is placed</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-sm me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="bx bx-badge-check"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Your item is shipped</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>3 min ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <a href="#!" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <img src="assets/images/users/avatar-6.jpg" class="rounded-circle avatar-sm" alt="user-pic">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">Salena Layfield</h6>
                                        <div class="font-size-13 text-muted">
                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> <span>1 hours ago</span></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="javascript:void(0)">
                                <i class="uil-arrow-circle-right me-1"></i> <span>View More..</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle">
                        <i class="icon-sm" data-eva="settings-outline"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    </button>
                    <div class="dropdown-menu dropdown-menu-end pt-0">
                        <div class="p-3 border-bottom">
                            <h6 class="mb-0">Jennifer Bennett</h6>
                            <p class="mb-0 font-size-11 text-muted">jennifer.bennett@email.com</p>
                        </div>
                        <a class="dropdown-item" href="contacts-profile.html"><i class="mdi mdi-account-circle text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
                        <a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"><i class="mdi mdi-wallet text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$6951.02</b></span></a>
                        <a class="dropdown-item d-flex align-items-center" href="#"><i class="mdi mdi-cog-outline text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Settings</span><span class="badge badge-soft-success ms-auto">New</span></a>
                        <a class="dropdown-item" href="auth-lock-screen.html"><i class="mdi mdi-lock text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
                        <a class="dropdown-item" href="auth-logout.html"><i class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span class="align-middle">Logout</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="topnav">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon nav-icon" data-eva="grid-outline"></i>
                                    <span data-key="t-dashboards">Dashboards</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                    <a href="{{route('Admin.dashboard')}}" class="dropdown-item" data-key="t-ecommerce">Ecommerce</a>
                                    <a href="dashboard-saas.html" class="dropdown-item" data-key="t-saas">Saas</a>
                                    <a href="dashboard-crypto.html" class="dropdown-item" data-key="t-crypto">Crypto</a>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="icon nav-icon" data-eva="cube-outline"></i>
                                    <span data-key="t-elements">Elements</span>
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <div class="menu-title">Elements</div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-alerts.html" class="dropdown-item" data-key="t-alerts">Alerts</a>
                                                                <a href="ui-buttons.html" class="dropdown-item" data-key="t-buttons">Buttons</a>
                                                                <a href="ui-cards.html" class="dropdown-item" data-key="t-cards">Cards</a>
                                                                <a href="ui-carousel.html" class="dropdown-item" data-key="t-carousel">Carousel</a>
                                                                <a href="ui-dropdowns.html" class="dropdown-item" data-key="t-dropdowns">Dropdowns</a>
                                                                <a href="ui-grid.html" class="dropdown-item" data-key="t-grid">Grid</a>
                                                                <a href="ui-images.html" class="dropdown-item" data-key="t-images">Images</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-lightbox.html" class="dropdown-item" data-key="t-lightbox">Lightbox</a>
                                                                <a href="ui-modals.html" class="dropdown-item" data-key="t-modals">Modals</a>
                                                                <a href="ui-offcanvas.html" class="dropdown-item" data-key="t-offcanvas">Offcanvas</a>
                                                                <a href="ui-rangeslider.html" class="dropdown-item" data-key="t-range-slider">Range Slider</a>
                                                                <a href="ui-progressbars.html" class="dropdown-item" data-key="t-progress-bars">Progress Bars</a>
                                                                <a href="ui-sweet-alert.html" class="dropdown-item" data-key="t-sweet-alert">Sweet-Alert</a>
                                                                <a href="ui-tabs-accordions.html" class="dropdown-item" data-key="t-tabs-accordions">Tabs & Accordions</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-typography.html" class="dropdown-item" data-key="t-typography">Typography</a>
                                                                <a href="ui-video.html" class="dropdown-item" data-key="t-video">Video</a>
                                                                <a href="ui-general.html" class="dropdown-item" data-key="t-general">General</a>
                                                                <a href="ui-colors.html" class="dropdown-item" data-key="t-colors">Colors</a>
                                                                <a href="ui-rating.html" class="dropdown-item" data-key="t-rating">Rating</a>
                                                                <a href="ui-notifications.html" class="dropdown-item" data-key="t-notifications">Notifications</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class="icon nav-icon" data-eva="archive-outline"></i>
                                    <span data-key="t-apps">Apps</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="apps-calendar.html" class="dropdown-item" data-key="t-calendar">Calendar</a>
                                    <a href="apps-chat.html" class="dropdown-item" data-key="t-chat">Chat</a>
                                    <a href="apps-file-manager.html" class="dropdown-item" data-key="t-filemanager">File Manager</a>


                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button">
                                            <span data-key="t-ecommerce">Ecommerce</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                            <a href="ecommerce-products.html" class="dropdown-item" data-key="t-products">Products</a>
                                            <a href="ecommerce-product-detail.html" class="dropdown-item" data-key="t-product-detail">Product Detail</a>
                                            <a href="ecommerce-orders.html" class="dropdown-item" data-key="t-orders">Orders</a>
                                            <a href="ecommerce-customers.html" class="dropdown-item" data-key="t-customers">Customers</a>
                                            <a href="ecommerce-cart.html" class="dropdown-item" data-key="t-cart">Cart</a>
                                            <a href="ecommerce-checkout.html" class="dropdown-item" data-key="t-checkout">Checkout</a>
                                            <a href="ecommerce-shops.html" class="dropdown-item" data-key="t-shops">Shops</a>
                                            <a href="ecommerce-add-product.html" class="dropdown-item" data-key="t-add-product">Add Product</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button">
                                            <span data-key="t-email">Email</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox.html" class="dropdown-item" data-key="t-inbox">Inbox</a>
                                            <a href="email-read.html" class="dropdown-item" data-key="t-read-email">Read Email</a>
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email-templates" role="button">
                                                    <span data-key="t-email-templates">Templates</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-email-templates">
                                                    <a href="email-template-basic.html" class="dropdown-item" data-key="t-basic-action">Basic Action</a>
                                                    <a href="email-template-alert.html" class="dropdown-item" data-key="t-alert-email">Alert Email</a>
                                                    <a href="email-template-billing.html" class="dropdown-item" data-key="t-bill-email">Billing Email</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoices" role="button">
                                            <span data-key="t-invoices">Invoices</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoices">
                                            <a href="invoices-list.html" class="dropdown-item" data-key="t-invoice-list">Invoice List</a>
                                            <a href="invoices-detail.html" class="dropdown-item" data-key="t-invoice-detail">Invoice Detail</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-projects" role="button">
                                            <span data-key="t-projects">Projects</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-projects">
                                            <a href="projects-grid.html" class="dropdown-item" data-key="t-p-grid">Projects Grid</a>
                                            <a href="projects-list.html" class="dropdown-item" data-key="t-p-list">Projects List</a>
                                            <a href="projects-create.html" class="dropdown-item" data-key="t-create-new">Create New</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="contacts-grid.html" class="dropdown-item" data-key="t-user-grid">User Grid</a>
                                            <a href="contacts-list.html" class="dropdown-item" data-key="t-user-list">User List</a>
                                            <a href="contacts-profile.html" class="dropdown-item" data-key="t-user-profile">Profile</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                    <i class="icon nav-icon" data-eva="layers-outline"></i>
                                    <span data-key="t-components">Components</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                                            <span data-key="t-forms">Forms</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements.html" class="dropdown-item" data-key="t-form-elements">Form Elements</a>
                                            <a href="form-layouts.html" class="dropdown-item" data-key="t-form-layouts">Form Layouts</a>
                                            <a href="form-validation.html" class="dropdown-item" data-key="t-form-validation">Form Validation</a>
                                            <a href="form-advanced.html" class="dropdown-item" data-key="t-form-advanced">Form Advanced</a>
                                            <a href="form-editors.html" class="dropdown-item" data-key="t-form-editors">Form Editors</a>
                                            <a href="form-uploads.html" class="dropdown-item" data-key="t-form-upload">Form File Upload</a>
                                            <a href="form-wizard.html" class="dropdown-item" data-key="t-form-wizard">Form Wizard</a>
                                            <a href="form-mask.html" class="dropdown-item" data-key="t-form-mask">Form Mask</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">contact" role="button">
                                            <span data-key="t-contacts">Contacts</span>
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table" role="button">
                                            <span data-key="t-tables">Tables</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic.html" class="dropdown-item" data-key="t-basic-tables">Basic Tables</a>
                                            <a href="tables-advanced.html" class="dropdown-item" data-key="t-advanced-tables">Advance Tables</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button">
                                            <span data-key="t-charts">Charts</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <div class="dropdown">
                                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-apex-charts" role="button">
                                                    <span data-key="t-apex-charts">Apex Charts</span>
                                                    <div class="arrow-down"></div>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="topnav-apex-charts">
                                                    <a href="charts-line.html" class="dropdown-item" data-key="t-line">Line</a>
                                                    <a href="charts-area.html" class="dropdown-item" data-key="t-area">Area</a>
                                                    <a href="charts-column.html" class="dropdown-item" data-key="t-column">Column</a>
                                                    <a href="charts-bar.html" class="dropdown-item" data-key="t-bar">Bar</a>
                                                    <a href="charts-mixed.html" class="dropdown-item" data-key="t-mixed">Mixed</a>
                                                    <a href="charts-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                                    <a href="charts-candlestick.html" class="dropdown-item" data-key="t-candlestick">Candlestick</a>
                                                    <a href="charts-boxplot.html" class="dropdown-item" data-key="t-boxplot">Boxplot</a>
                                                    <a href="charts-bubble.html" class="dropdown-item" data-key="t-bubble">Bubble</a>
                                                    <a href="charts-scatter.html" class="dropdown-item" data-key="t-scatter">Scatter</a>
                                                    <a href="charts-heatmap.html" class="dropdown-item" data-key="t-heatmap">Heatmap</a>
                                                    <a href="charts-treemap.html" class="dropdown-item" data-key="t-treemap">Treemap</a>
                                                    <a href="charts-pie.html" class="dropdown-item" data-key="t-pie">Pie</a>
                                                    <a href="charts-radialbar.html" class="dropdown-item" data-key="t-radialbar">Radialbar</a>
                                                    <a href="charts-radar.html" class="dropdown-item" data-key="t-radar">Radar</a>
                                                    <a href="charts-polararea.html" class="dropdown-item" data-key="t-polararea">Polararea</a>
                                                </div>
                                            </div>
                                            <a href="charts-echart.html" class="dropdown-item" data-key="t-e-charts">E Charts</a>
                                            <a href="charts-chartjs.html" class="dropdown-item" data-key="t-chartjs-charts">Chartjs Charts</a>
                                            <a href="charts-tui.html" class="dropdown-item" data-key="t-ui-charts">Toast UI Charts</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button">
                                            <span data-key="t-icons">Icons</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                            <a href="icons-evaicons.html" class="dropdown-item" data-key="t-evaicons">Eva Icons</a>
                                            <a href="icons-boxicons.html" class="dropdown-item" data-key="t-boxicons">Boxicons</a>
                                            <a href="icons-materialdesign.html" class="dropdown-item" data-key="t-material-design">Material Design</a>
                                            <a href="icons-fontawesome.html" class="dropdown-item" data-key="t-font-awesome">Font Awesome 5</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map" role="button">
                                            <span data-key="t-maps">Maps</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                                            <a href="maps-google.html" class="dropdown-item" data-key="t-google">Google</a>
                                            <a href="maps-vector.html" class="dropdown-item" data-key="t-vector">Vector</a>
                                            <a href="maps-leaflet.html" class="dropdown-item" data-key="t-leaflet">Leaflet</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                    <i class="icon nav-icon" data-eva="file-text-outline"></i>
                                    <span data-key="t-pages">Pages</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-authentication" role="button">
                                            <span data-key="t-authentication">Authentication</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-authentication">
                                            <a href="auth-login.html" class="dropdown-item" data-key="t-login">Login</a>
                                            <a href="auth-register.html" class="dropdown-item" data-key="t-register">Register</a>
                                            <a href="auth-recoverpw.html" class="dropdown-item" data-key="t-recover-password">Recover Password</a>
                                            <a href="auth-lock-screen.html" class="dropdown-item" data-key="t-lock-screen">Lock Screen</a>
                                            <a href="auth-logout.html" class="dropdown-item" data-key="t-logout">Logout</a>
                                            <a href="auth-confirm-mail.html" class="dropdown-item" data-key="t-confirm-mail">Confirm Mail</a>
                                            <a href="auth-email-verification.html" class="dropdown-item" data-key="t-email-verification">Email Verification</a>
                                            <a href="auth-two-step-verification.html" class="dropdown-item" data-key="t-two-step-verification">Two Step Verification</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                                            <span data-key="t-utility">Utility</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter.html" class="dropdown-item" data-key="t-starter-page">Starter Page</a>
                                            <a href="pages-maintenance.html" class="dropdown-item" data-key="t-maintenance">Maintenance</a>
                                            <a href="pages-comingsoon.html" class="dropdown-item" data-key="t-coming-soon">Coming Soon</a>
                                            <a href="pages-timeline.html" class="dropdown-item" data-key="t-timeline">Timeline</a>
                                            <a href="pages-faqs.html" class="dropdown-item" data-key="t-faqs">FAQs</a>
                                            <a href="pages-pricing.html" class="dropdown-item" data-key="t-pricing">Pricing</a>
                                            <a href="pages-404.html" class="dropdown-item" data-key="t-error-404">Error 404</a>
                                            <a href="pages-500.html" class="dropdown-item" data-key="t-error-500">Error 500</a>
                                        </div>
                                    </div>

                                    <a href="layouts-horizontal.html" class="dropdown-item" data-key="t-horizontal">Horizontal</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>
