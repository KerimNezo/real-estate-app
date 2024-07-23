<x-property>
    <x-slot:title>
        Realestate
    </x-slot>

    <div class="py-32 text-center text-black bg-white" id="property-query" style="height: fit-content; background-image: url('photos/pozadina.jpg'); background-size: cover; background-position:center 900px;">
        <div id="query-title" style="font-size:24px; padding-bottom: 54px; padding-top: 103px;">
            <h1 class="text-color">WELCOME TO OUR PAGE</h1>
        </div>
        <div id="query-sub-title" style="font-size:48px; padding-bottom: 160px;">
            <h1 class="text-color">One step closer to your dream home...</h1>
        </div>
        <div id="query-form-div" style="display:flex; justify-content: center; align-items: center; " class="" >
            <div id="query-form" style="background-color: #5eb1f0; width:80%; height:120px; border-radius: 5px;">
                <table style="width: 100%; margin-bottom: auto; height: 100%;">
                    <tr style="width: 100%; height: 100%; margin-top: auto;">
                        <form action="/search" method="GET">
                            <td style="padding-bottom: 20px; padding-left: 30px; padding-right: 0px; width: 220px; vertical-align: bottom;">
                                <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                                    <span style="text-align: left; margin-bottom: 5px; width: 220px;">Property type</span>
                                    <select id="" style="border-radius: 5px; border: 2px solid #989898; height: 35px; width: 220px; padding-left: 10px;" name="exact[type-of-asset-id]">
                                        <option value="0" >Choose property type</option>
                                        <option value="1">Office</option>
                                        <option value="2">House</option>
                                        <option value="3">Appartement</option>
                                    </select>
                                </div>
                            </td>

                            <td style="padding-left: 26px; padding-bottom: 20px; width: 200px; vertical-align: bottom;">
                                <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                                    <span style="text-align: left; margin-bottom: 5px; width: 200px;">Price</span>
                                    <input type="text" placeholder="1200" style="border-radius: 5px; border: 2px solid #989898; height: 35px; width: 200px;" name="min-price">
                                </div>
                            </td>

                            <td style="margin-top: auto; padding-bottom: 26px; height: 51px; width: 26px;">
                                <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                                    <span>to</span>
                                </div>
                            </td>

                            <td style="padding-bottom: 20px; margin-top: auto; margin-right: auto; width: 200px;">
                                <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                                    <input type="text" placeholder="100000" style="border-radius: 5px; border: 2px solid #989898; height: 35px; width: 200px;" name="max-cijena">
                                </div>
                            </td>

                            <td style="padding-right: 30px; padding-bottom: 20px; margin-bottom: auto; width: auto;">
                                <div style="display: flex; flex-direction: column; justify-content: flex-end; height: 100%;">
                                    <button style="width: 220px; border-radius:5px; height: 64px; background-color:#ef5d60; vertical-align: bottom; margin-left: auto;">Submit</button>
                                </div>
                            </td>
                        </form>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <main class="">
        <div class="py-16 text-center text-black" style="background-color:#33a488;">
            <h1>Featured Properties</h1>
            <span>site prima listu featured propertya, koje će ovdje pokazati preko kartica</span>
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
