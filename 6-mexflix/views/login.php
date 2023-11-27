<div class="flex justify-center mt-5">
    <form method="post" class="space-y-2">
        <div>
            <input 
                type="text" 
                name="user" 
                placeholder="usuario" 
                required 
                class="border border-gray-600 p-1 rounded-sm"
            >
        </div>
        <div>
            <input 
                type="password"
                name="password" 
                placeholder="password" 
                required
                class="border border-gray-600 p-1 rounded-sm"
            >
        </div>
        <div>
            <input 
                type="submit"
                value="Enviar"
                class="bg-pink-700 w-full p-1 rounded-sm text-white"
            >
        </div>
    </form>
</div>

<?php if(isset($_GET['error'])) { ?>
    <div class="container mx-auto mt-4">
        <p class="text-red-700 text-center font-semibold">
            <?php print $_GET['error']; ?>
        </p>
    </div>

<?php } ?>