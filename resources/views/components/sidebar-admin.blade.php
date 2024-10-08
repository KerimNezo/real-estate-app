<!-- Sidebar -->
<div id="sidebar" class="fixed top-[100px] left-0 w-[220px] h-screen px-5 sm:px-10 sm:bg-opacity-0 bg-opacity-95 bg-gray-900 z-10 transform -translate-x-full transition-transform duration-300 sm:translate-x-0 lg:block">    <!-- Logo -->
    <div id="admin-sidebar-logo">
        <div class="mx-auto mt-5">
            <a href="/">
                <img src={{ asset('photos/icons/logo1.svg')}} alt="alt" class="rounded-[5px] lg:h-12 h-11">
            </a>
        </div>
    </div>

    <!-- Agents -->
    <div class="mr-auto">
        <x-section-title text="Agents" image="heroicon-s-user"/>

        <x-section-option text="List" link="/agents/index"/>
    </div>

    <!-- Properties -->
    <div class="mr-auto">
        <x-section-title text="Properties" image="phosphor-house-line-fill"/>

        <div class="flex flex-col items-center justify-center gap-4">
            <x-section-option text="Houses" link="/property/houses"/>

            <x-section-option text="Offices" link="/property/pffices"/>

            <x-section-option text="Appartements" link="/property/appartements"/>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="mb-auto mr-auto">
        <x-section-title text="Dashboard" image="simpleline-graph"/>

        <x-section-option text="Stats" link="/dashboard"/>
    </div>

     <!-- mobile view menu button script -->
     <script>
        const menuButton = document.getElementById('menu');
        const sidebar = document.getElementById('sidebar');
        let isSidebarVisible = false;

        menuButton.addEventListener('click', function() {
            if (!isSidebarVisible) {
                sidebar.classList.remove('-translate-x-full');
                isSidebarVisible = true;
            } else {
                sidebar.classList.add('-translate-x-full');
                isSidebarVisible = false;
            }
        });

        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickInsideMenuButton = menuButton.contains(event.target);

            if (!isClickInsideSidebar && !isClickInsideMenuButton && isSidebarVisible) {
                sidebar.classList.add('-translate-x-full');
                isSidebarVisible = false;
            }
        });
    </script>
</div>
