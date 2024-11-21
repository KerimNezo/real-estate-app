@if (session('success'))
    <div id="sessionMessage" class="px-[12%] flex justify-center items-center pb-6">
        <div id="sessionMessageSuccess" class="relative p-4 text-white bg-green-500 rounded-md w-[400px] justify-center items-center" >
            <span class="absolute flex items-center justify-center px-[9px] py-0 text-base text-white bg-green-700 rounded-full cursor-pointer top-1 right-1 text-center" onclick="closeSessionMessage()">&times;</span>

            <p class="text-center">
                {{ session('success') }}
            </p>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="sessionMessage" class="px-[12%] flex justify-center items-center pb-6">
        <div id="sessionMessageError" class="relative p-4 text-white bg-red-500 rounded-md w-[400px] justify-center items-center" >
            <span class="absolute flex items-center justify-center px-[10px] py-0 text-base text-white bg-red-700 rounded-full cursor-pointer top-1 right-1 text-center" onclick="closeSessionMessage()">&times;</span>

            <p class="text-center">
                {{ session('error') }}
            </p>
        </div>
    </div>
@endif
