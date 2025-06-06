<form action="<?php echo $path; ?>admin/comment/addReply/<?php echo $data['comment']->comid ?>" method="post" class="max-w-6xl mx-auto space-y-8 p-6 bg-white shadow-md rounded-lg dark:bg-gray-800 dark:text-white">
    <div class="flex items-center justify-between">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Phản hồi</div>
        <hr class="border-gray-300 mb-6 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Tên nhà hàng -->
        <div class="flex items-center">
            <label class="text-lg font-medium text-gray-900 dark:text-white w-1/4">Tên nhà hàng</label>
            <div class="w-3/4 bg-gray-50 text-gray-900 text-sm p-3 dark:bg-gray-700 dark:text-white">
                <?php echo $data['comment']->restaurant_name ?>
            </div>
        </div>

        <!-- Người dùng -->
        <div class="flex items-center">
            <label class="text-lg font-medium text-gray-900 dark:text-white w-1/4">Người dùng</label>
            <div class="w-3/4 bg-gray-50 text-gray-900 text-sm p-3 dark:bg-gray-700 dark:text-white">
                <?php echo $data['comment']->name ?>
            </div>
        </div>

        <!-- Email -->
        <div class="flex items-center">
            <label class="text-lg font-medium text-gray-900 dark:text-white w-1/4">Email</label>
            <div class="w-3/4 bg-gray-50 text-gray-900 text-sm p-3 dark:bg-gray-700 dark:text-white">
                <?php echo $data['comment']->email ?>
            </div>
        </div>

        <!-- SĐT -->
        <div class="flex items-center">
            <label class="text-lg font-medium text-gray-900 dark:text-white w-1/4">SĐT</label>
            <div class="w-3/4 bg-gray-50 text-gray-900 text-sm p-3 dark:bg-gray-700 dark:text-white">
                <?php echo $data['comment']->phone ?>
            </div>
        </div>

        <!-- Nội dung -->
        <div class="flex items-center">
            <label class="text-lg font-medium text-gray-900 dark:text-white w-1/4">Nội dung</label>
            <div class="w-3/4 bg-gray-50 text-gray-900 text-sm p-3 dark:bg-gray-700 dark:text-white">
                <?php echo $data['comment']->cmt ?>
            </div>
        </div>

        <!-- Phản hồi -->
        <div class="flex items-center">
            <label for="response" class="text-lg font-medium text-gray-900 dark:text-white w-1/4">Phản hồi</label>
            <textarea name="response" id="response" class="w-3/4 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-3 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" value="<?php echo $data['comment']->reply; ?>"></textarea>
        </div>
    </div>

    <div class="flex justify-end space-x-4 mt-8">
        <button name="resSubmit" type="submit" class="px-6 py-3 bg-teal-500 text-white border border-teal-500 rounded-lg shadow-md transform transition duration-300 ease-in-out hover:bg-teal-600 hover:scale-110 hover:shadow-lg font-semibold focus:outline-none">Lưu phản hồi</button>
        <a href="<?php echo $path; ?>admin/comment" class="px-6 py-3 bg-indigo-500 text-white border border-indigo-500 rounded-lg shadow-md transform transition duration-300 ease-in-out hover:bg-indigo-600 hover:scale-110 hover:shadow-lg font-semibold focus:outline-none">
            Quay lại
        </a>
    </div>
</form>
