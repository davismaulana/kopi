<div id="modalView" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-latte text-espresso p-8 rounded-lg shadow-lg max-w-lg w-full">
        <div class="mb-4">
            <img id="menuImage" alt="Menu Image" class="w-80 h-80 object-cover rounded-lg mx-auto mb-4">
        </div>
    
        <h1 class="text-xl font-bold mb-4">Menu Details</h1>
        <h3><strong>Name:</strong> <p id="menuName"></p></h3>
        <h3><strong>Price:</strong> Rp. <p id="menuPrice"></p></h3>
        <h3><strong>Stock:</strong> <p id="menuStock"></p></h3>
        <h3><strong>Category:</strong> <p id="menuCategory"></p></h3>
        
        <button onclick="closeModalView()" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-4">Close</button>
    </div>
</div>