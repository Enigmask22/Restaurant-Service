<div class="p-6 mx-auto max-w-[1500px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="flex justify-between items-center mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Quản lý hình ảnh nhà hàng</div>
        <a href="<?php echo $path ?>restaurant/resimg/add_image"
            class="px-4 py-2 text-teal-500 transition duration-300 ease-in-out transform border border-teal-500 rounded-lg hover:bg-teal-500 hover:text-white hover:scale-105">
            Thêm hình ảnh
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($data['images'])): ?>
        <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400">
            Chưa có hình ảnh nào. Hãy thêm hình ảnh mới.
        </div>
        <?php else: ?>
        <?php foreach ($data['images'] as $image): ?>
        <div class="relative group overflow-hidden rounded-lg shadow-md">
            <img src="<?php echo isset($image['path']) ? $image['path'] : 'https://via.placeholder.com/400x300?text=No+Image'; ?>"
                alt="Restaurant Image"
                class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">
            <div
                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <a href="<?php echo $path ?>restaurant/resimg/delete_image/<?php echo $image['imageid']; ?>"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa hình ảnh này?');"
                        class="px-4 py-2 bg-rose-500 text-white rounded-lg hover:bg-rose-600 transition duration-300">
                        Xóa
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>