<x-property>
    <x-slot:title>
        Realestate
    </x-slot>

    <div class="py-32 text-center text-black bg-white h-fit bg-hero-image bg-cover bg-[center 900px]" id="property-query" style="background-image: url('photos/pozadina.jpg')">
        <div class="text-2xl pb-[54px] pt-[103px]" id="query-title">
            <h1 class="text-color">WELCOME TO OUR PAGE</h1>
        </div>
        <div class="text-5xl pb-[160px]" id="query-sub-title">
            <h1 class="text-color">One step closer to your dream home...</h1>
        </div>
        <div id="query-form-div" class="flex justify-center items-center" >
            <div id="query-form" class="bg-[#5eb1f0] w-[80%] h-[120px] rounded-[5px]">
                <table class="w-full mb-auto h-full">
                    <tr class="w-full h-full mt-auto">
                        <form action="/search" method="GET">
                            <td class="pb-[20px] pl-[30px] w-[220px] align-bottom">
                                <div class="flex flex-col justify-end h-full">
                                    <span class="mb-[5px] w-[220px] text-left">Property type</span>
                                    <select id="" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[220px] pl-[10px]" name="exact[type-of-asset-id]">
                                        <option value="0" >Choose property type</option>
                                        <option value="1">Office</option>
                                        <option value="2">House</option>
                                        <option value="3">Appartement</option>
                                    </select>
                                </div>
                            </td>

                            <td class="pl-[26px] pb-5 w-[200px] align-bottom">
                                <div class="flex justify-end flex-col h-full">
                                    <span class="text-left mb-[5px] w-[200px]">Price</span>
                                    <input type="text" placeholder="1200" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="min-price">
                                </div>
                            </td>

                            <td class="mt-auto pb-[26px] h-[51px] w-[26px]">
                                <div class="flex flex-col justify-end h-full">
                                    <span>to</span>
                                </div>
                            </td>

                            <td class="pb-5 mt-auto mr-auto w-[200px]">
                                <div class="flex flex-col justify-end h-full">
                                    <input type="text" placeholder="100000" class="rounded-[5px] border-2 border-[#989898] border-solid h-[35px] w-[200px]" name="max-cijena">
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
        </div>
    </div>

    <main>
        <div class="py-16 text-black bg-white h-fit w-full" id="featured-properties">
            <x-title position="left"/> <!-- Ovo ako je left, ide lijevo, ako nije left, ide u centar -->

            <div class="text-center text-xl py-12">
                <div class="px-[10%] grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full"> <!-- ovdje sad treba editovati kako se pozicioniraju -->
                    @foreach ($properties as $property )
                        <a href="/property/{{$property->id}}">
                            <x-property-card :$property/>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="text-center text-xl">
                <a href="/all-properties">
                    <span>See all properties →</span>
                </a>
            </div>
        </div>
    </main>

    <div class="py-16 text-center text-sm text-black bg-white"  id="property-types">
        <h1>Types of property for sale/rent</h1>
        <span>Imamo prikaz ikona svakog propertya koji nudimo na stranici</span>
    </div>

    <div class="py-16 text-center text-sm text-black bg-white"  id="about-section">
        <h1>About us</h1>
        <span>Prikaz poruke i misije naše kompanije</span>
    </div>

    <div class="py-16 text-center text-sm text-black bg-white"  id="team-section">
        <h1>Our team</h1>
        <span>prikaz agenata</span>
    </div>

    <footer class="py-16 text-center text-sm text-black bg-white" id="contact-section">
        <h1>Footer</h1>
        <span>Footer stranice, sa svim linkovima, social media linkovima i policy stuff</span>
    </footer>
</x-property>
