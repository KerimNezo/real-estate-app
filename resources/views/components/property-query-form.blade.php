

<div id="query-form">
    <table class="w-full h-full mb-auto">
        <tr class="w-full h-full mt-auto">
            <form action="/search" method="GET">
                @csrf
                <td class="pb-[20px] pl-[30px] w-[220px] align-bottom">
                    <div class="flex flex-col justify-end h-full">
                        <span class="mb-[5px] w-[220px] text-left">Property type</span>

                        <select id="" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[220px] pl-[10px]" name="type-of-asset-id">
                            <option value="0">Choose property type</option>
                            <option value="1">Office</option>
                            <option value="2">House</option>
                            <option value="3">Appartement</option>
                        </select>
                    </div>
                </td>

                <td class="pl-[26px] pb-5 w-[200px] align-bottom">
                    <div class="flex flex-col justify-end h-full">
                        <span class="text-left mb-[5px] w-[200px]">Price</span>

                        <input type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="min-price">
                    </div>
                </td>

                <td class="mt-auto pb-[26px] h-[51px] w-[26px]">
                    <div class="flex flex-col justify-end h-full">
                        <span>
                            to
                        </span>
                    </div>
                </td>

                <td class="pb-5 mt-auto mr-auto w-[200px]">
                    <div class="flex flex-col justify-end h-full">
                        <input type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="max-price">
                    </div>
                </td>

                <td class="pr-[30px] pb-5 mb-auto w-auto">
                    <div class="flex flex-col justify-end h-full">
                        <button class="w-[220px] rounded-[5px] h-16 bg-[#ef5d60] align-bottom ml-auto">Submit</button>
                    </div>
                </td>
            </form>
        </tr>
    </table>
</div>

<!-- Mobile view query form -->
<div id="mobile-query-form">
    <table class="w-full h-full mb-auto ">
        <form action="/search" method="GET">
            <tr class="w-full h-full mt-auto">
                <td class="py-[20px] w-[80%] align-bottom">
                    <div class="flex flex-col items-center justify-center h-full">
                        <span class="mb-[5px] w-[80%] text-left">Property type</span>

                        <select id="" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[80%] pl-[10px]" name="type-of-asset-id">
                            <option value="0">Choose property type</option>
                            <option value="1">Office</option>
                            <option value="2">House</option>
                            <option value="3">Appartement</option>
                        </select>
                    </div>
                </td>
            </tr>

            <tr class="w-full h-full mt-auto">
                <td class="py-[10px] w-full align-bottom">
                    <div class="flex-col items-center justify-center w-full">
                        <div class="text-left mb-[5px] w-[80%] pl-[10%]">
                            <span>
                                Price
                            </span>
                        </div>

                        <div class="flex-row justify-start items-star w-[100%] px-[4%]">
                            <input type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid w-[40%] h-[35px]" name="min-price">

                            <span>to</span>

                            <input type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid w-[40%] h-[35px]" name="max-price">
                        </div>
                    </div>
                </td>
            </tr>

            <!-- Confirm button -->
            <tr>
                <td class="px-[10%] py-[20px] pb-5 mb-auto w-auto">
                    <div class="flex flex-col justify-end h-full">
                        <button class="w-full rounded-[5px] h-16 bg-[#ef5d60] align-bottom ">Submit</button>
                    </div>
                </td>
            </tr>
        </form>
    </table>
</div>
