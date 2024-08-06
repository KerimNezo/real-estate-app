<!-- Desktop view navbar-->
<div id="guest-navbar">
    <header class="grid grid-cols-2 items-center lg:grid-cols-2 py-[24px] w-[80%] ml-[10%]">
        <div class="pr-auto w-[220px] h-[55px]">
            <a href="/">
                <img src={{ ('photos/logo1.svg')}} alt="alt" class="rounded-[5px]">
            </a>
        </div>

        <div class="flex justify-center items-end w-full">
            <a rel="noopener" href="all-properties" class="ml-auto">
                <span class="navbar-text">All properties</span>
            </a>

            <a rel="noopener" href="/#property-types" class="ml-auto">
                <span class="navbar-text">Types of properties</span>
            </a>

            <a rel="noopener" href="/#about-section" class="ml-auto">
                <span class="navbar-text">About us</span>
            </a>

            <a rel="noopener" href="/#contact-section" class="ml-auto">
                <span class="navbar-text">Contact us</span>
            </a>
        </div>
    </header>
</div>

<!-- Mobile view navbar -->
<div id="mobile-guest-navbar">
    <header class="flex justify-start items-center text-center py-[24px] w-full">
        <div class="ml-[10%] h-[50px] flex justify-center items-center mr-auto">
            <a href="/">
                <img src={{ ('photos/logo1.svg')}} alt="alt" class="rounded-[5px]">
            </a>
        </div>

        <div class="mr-[10%] flex justify-center items-center ">
            <button type="button" id="button" class="collapsible">
                <img src={{ ('photos/menu-icon.svg')}} alt="menu-icon" class="w-[35px]">
            </button>
        </div>

    </header>
    <div class="origin-top pt-[10px]" id="mobile-guest-collapse-content" style="display: none;">
        <div class="flex flex-row items-center w-[100%] gap-4 mx-auto">
            <div class="w-[50%] pl-[5%]">
                <a rel="noopener" href="all-properties">
                    <span class="navbar-text text-base">All properties</span>
                </a>
            </div>

            <div class="w-[50%]">
                <a rel="noopener" href="/#property-types">
                    <span class="navbar-text text-base">Types of properties</span>
                </a>
            </div>
        </div>

        <div class="flex flex-row items-center w-[100%] gap-4 mx-auto pt-2">
            <div class="w-[50%] pl-[5%]">
                <a rel="noopener" href="/#about-section">
                    <span class="navbar-text text-base">About us</span>
                </a>
            </div>

            <div class="w-[50%]">
                <a rel="noopener" href="/#contact-section">
                    <span class="navbar-text text-base">Contact us</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('button').addEventListener('click', function() {
        var content = document.getElementById('mobile-guest-collapse-content');
        if (content.style.display === 'none' || content.classList.contains('show') === false) {
            content.classList.add('show');
            content.style.display = 'block';
            setTimeout(function() {
                content.style.opacity = 1;
            }, 10); // Small delay to ensure the transition works
        } else {
            content.style.opacity = 0;
            setTimeout(function() {
                content.style.display = 'none';
                content.classList.remove('show');
            }, 500); // Match this duration with the CSS transition duration
        }
    });
</script>
