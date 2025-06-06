<div class="p-6 mx-auto max-w-[1500px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thêm hình ảnh mới</div>
        <hr class="mt-2 border-gray-300 dark:border-gray-700">
    </div>

    <form action="<?php echo $path ?>restaurant/resimg/add_image" method="POST" enctype="multipart/form-data"
        class="space-y-6">
        <div class="flex flex-col">
            <label for="restaurant_image" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Chọn hình
                ảnh</label>
            <input type="file" name="restaurant_image" id="restaurant_image" accept="image/*"
                class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Chọn hình ảnh từ máy tính của bạn (JPG, PNG, GIF,
                WEBP).</p>
        </div>

        <div class="flex justify-end space-x-4">
            <button type="submit"
                class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                Thêm hình ảnh
            </button>
            <a href="<?php echo $path ?>restaurant/resimg"
                class="px-6 py-3 font-semibold text-white bg-gray-500 rounded-lg border border-gray-500 shadow-md transition duration-300 ease-in-out transform hover:bg-gray-600 hover:scale-110 hover:shadow-lg focus:outline-none">
                Hủy
            </a>
        </div>
    </form>
</div>