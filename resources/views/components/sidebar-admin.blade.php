<!-- Sidebar -->
<div class="fixed top-[100px] left-0 w-[220px] h-screen px-10 bg-gray-900 z-10 flex flex-col items-center justify-center">
    <!-- Logo -->
    <div id="admin-sidebar-logo">
        <div class="mx-auto mt-5">
            <a href="/">
                <img src={{ asset('photos/icons/logo1.svg')}} alt="alt" class="rounded-[5px] h-12">
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
</div>
