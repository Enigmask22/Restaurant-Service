<div class="grid grid-cols-1 gap-6 p-6 mx-auto max-w-[1500px] lg:grid-cols-2">
    <!-- Phần thông tin nhà hàng -->
    <form action="<?php echo $path ?>restaurant/home/update_restaurant/<?php echo $_SESSION['restaurant-id'] ?>"
        method="POST" enctype="multipart/form-data"
        class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white" id="thong-tin">
        <div class="flex items-center justify-between mb-6">
            <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin nhà hàng</div>
            <hr class="border-gray-300 dark:border-gray-700">
        </div>

        <div class="space-y-6">
            <div class="flex items-center">
                <label for="restaurant_name" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Tên nhà
                    hàng</label>
                <input type="text" name="restaurant_name" id="restaurant_name"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="<?php echo $data['restaurant_data']['restaurant'][0]['restaurant_name'] ?>" required>
            </div>

            <div class="flex items-center">
                <label for="res_mail" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Email</label>
                <input type="email" name="res_mail" id="res_mail"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="<?php echo $data['restaurant_data']['restaurant'][0]['res_mail'] ?? '' ?>" required>
            </div>

            <div class="flex items-center">
                <label for="adult_price" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Giá người
                    lớn</label>
                <input type="text" name="adult_price" id="adult_price"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="<?php echo $data['restaurant_data']['restaurant'][0]['original_adult_price'] ?>" required>
            </div>

            <div class="flex items-center">
                <label for="child_price" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Giá trẻ
                    em</label>
                <input type="text" name="child_price" id="child_price"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="<?php echo $data['restaurant_data']['restaurant'][0]['original_child_price'] ?>" required>
            </div>

            <div class="flex items-center">
                <label for="discount" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Giảm giá
                    (%)</label>
                <input type="number" name="discount" id="discount"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    value="<?php echo $data['restaurant_data']['restaurant'][0]['discount'] ?>" min="0" max="100">
            </div>

            <div class="flex items-center">
                <label for="res_include" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Bao gồm</label>
                <textarea name="res_include" id="res_include" rows="4"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required><?php echo $data['restaurant_data']['restaurant'][0]['res_include'] ?></textarea>
            </div>

            <div class="flex items-center">
                <label for="res_exclude" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Không bao
                    gồm</label>
                <textarea name="res_exclude" id="res_exclude" rows="4"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo $data['restaurant_data']['restaurant'][0]['res_exclude'] ?></textarea>
            </div>

            <div class="flex items-center">
                <label for="res_condition" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Điều kiện đặt
                    nhà hàng</label>
                <textarea name="res_condition" id="res_condition" rows="4"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo $data['restaurant_data']['restaurant'][0]['res_condition'] ?></textarea>
            </div>

            <div class="flex items-center">
                <label for="address" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Địa chỉ</label>
                <select id="address" name="address"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                    <option value="<?php echo $data['restaurant_data']['restaurant'][0]['address'] ?>">
                        <?php echo $data['restaurant_data']['restaurant'][0]['address'] ?>
                    </option>
                    <?php foreach (array("TPHCM" => "Thành phố Hồ Chí Minh", "DN" => "Đà Nẵng", "VT" => "Vũng Tàu", "HA" => "Hội An", "HN" => "Hà Nội", "H" => "Huế") as $value => $addr) {
                        if ($addr !== $data['restaurant_data']['restaurant'][0]['address']) {
                            echo "<option value=\"$addr\">$addr</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="flex items-center">
                <label for="res_rate" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Chất lượng nhà
                    hàng</label>
                <select id="res_rate" name="res_rate"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                    <option value="<?php echo $data['restaurant_data']['restaurant'][0]['res_rate'] . ' sao' ?>">
                        <?php echo $data['restaurant_data']['restaurant'][0]['res_rate'] . ' sao' ?>
                    </option>
                    <?php foreach (array("1" => '1 sao', "2" => "2 sao", "3" => "3 sao", "4" => "4 sao", "5" => "5 sao", ) as $value => $danh_gia) {
                        if ($danh_gia !== $data['restaurant_data']['restaurant'][0]['res_rate'] . ' sao') {
                            echo "<option value=\"$value\">$danh_gia</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="flex items-center">
                <label for="open_time" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Giờ mở
                    cửa</label>
                <select id="open_time" name="open_time"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required>
                    <option value="<?php echo $data['restaurant_data']['restaurant'][0]['open_time'] ?>">
                        <?php echo $data['restaurant_data']['restaurant'][0]['open_time'] ?>
                    </option>
                    <?php foreach (array("8h" => "08:00:00", "9h" => "09:00:00", "10h" => "10:00:00", "11h" => "11:00:00", "12h" => "12:00:00", "13h" => "13:00:00", "14h" => "14:00:00", "15h" => "15:00:00", "16h" => "16:00:00", "17h" => "17:00:00", ) as $value => $res_time) {
                        if ($res_time !== $data['restaurant_data']['restaurant'][0]['open_time']) {
                            echo "<option value=\"$res_time\">$res_time</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="flex items-center">
                <label for="description" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Mô tả</label>
                <textarea name="description" id="description" rows="10"
                    class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo $data['restaurant_data']['restaurant'][0]['description'] ?></textarea>
            </div>

            <div class="flex items-center">
                <label for="image" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Hình ảnh</label>
                <div class="w-3/4 flex flex-col">
                    <div class="flex items-center space-x-4">
                        <input type="file" name="restaurant_image" id="restaurant_image" accept="image/*"
                            class="p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <input type="hidden" name="image" id="image"
                            value="<?php echo $data['restaurant_data']['restaurant'][0]['avatar'] ?>">
                    </div>
                    <div class="mt-2">
                        <img id="preview_image" src="<?php echo $data['restaurant_data']['restaurant'][0]['avatar'] ?>"
                            class="h-32 w-auto object-cover rounded-lg border border-gray-300" alt="Restaurant preview">
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Chọn hình ảnh từ máy tính của bạn (JPG,
                        PNG, GIF, WEBP) hoặc giữ nguyên hình ảnh hiện tại.</p>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-8 space-x-4">
            <button
                class="px-6 py-3 font-semibold text-white transition duration-300 ease-in-out transform bg-teal-500 border border-teal-500 rounded-lg shadow-md hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none"
                type="submit">Lưu thay đổi</button>
            <button
                class="px-6 py-3 font-semibold text-white transition duration-300 ease-in-out transform border rounded-lg shadow-md bg-rose-500 border-rose-500 hover:bg-rose-600 hover:scale-110 hover:shadow-lg focus:outline-none"
                type="reset">Bỏ thay đổi</button>
            <button name="returnSubmit"
                class="px-6 py-3 font-semibold text-white transition duration-300 ease-in-out transform bg-indigo-500 border border-indigo-500 rounded-lg shadow-md hover:bg-indigo-600 hover:scale-110 hover:shadow-lg focus:outline-none"
                type="submit">Quay lại</button>
        </div>
    </form>

    <!-- Phần thông tin địa chỉ -->
    <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
        <div class="flex items-center justify-between mb-6">
            <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin địa chỉ</div>
            <button onclick="addRes(<?php echo $data['rid'] ?>)"
                class="px-4 py-2 text-teal-500 transition duration-300 ease-in-out transform border border-teal-500 rounded-lg hover:bg-teal-500 hover:text-white hover:scale-105">
                Thêm địa chỉ
            </button>
        </div>

        <form action="<?php echo $path ?>restaurant/home/addAddress" method="POST" class="space-y-6 schedule-list">
            <?php foreach ($data['restaurant_data']['address'] as $key => $value) { ?>
                <div class="p-4 space-y-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <div class="flex items-center">
                        <label for="branch" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Chi
                            nhánh</label>
                        <input type="text" name="branch" id="branch"
                            class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            value="<?php echo $value['branch'] ?>">
                    </div>

                    <div class="flex items-center">
                        <label for="location" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Địa
                            điểm</label>
                        <input type="text" name="location" id="location"
                            class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            value="<?php echo $value['location'] ?>">
                    </div>

                    <div class="flex items-center">
                        <label for="description" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Mô tả địa
                            điểm</label>
                        <textarea name="description" id="description" rows="10"
                            class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"><?php echo $value['description'] ?></textarea>
                    </div>

                    <input type="hidden" name="aid" value="<?php echo $value['aid']; ?>">
                    <input type="hidden" name="r_id" value="<?php echo $value['r_id']; ?>">

                    <div class="flex justify-end mt-4 space-x-4">
                        <a href="<?php echo $path ?>restaurant/home/deleteAddress/<?php echo $value['r_id'] . '/' . $value['aid'] . '/' . $value['branch']; ?>"
                            class="px-4 py-2 text-rose-500 border border-rose-500 rounded-lg transition duration-300 ease-in-out transform hover:bg-rose-500 hover:text-white hover:scale-105 <?php if ($key !== array_key_last($data['restaurant_data']['address']))
                                echo "pointer-events-none opacity-50"; ?>">
                            Xóa địa chỉ
                        </a>
                        <button name="changeAddress"
                            class="px-4 py-2 text-teal-500 transition duration-300 ease-in-out transform border border-teal-500 rounded-lg hover:bg-teal-500 hover:text-white hover:scale-105"
                            type="submit">
                            Sửa địa chỉ
                        </button>
                    </div>
                </div>
            <?php } ?>
        </form>
    </div>
</div>

<script>
    function addRes(rid) {
        const list = document.querySelector(".schedule-list");
        const newNode = document.createElement("div");
        newNode.className = "p-4 bg-gray-50 rounded-lg dark:bg-gray-700 space-y-4";
        newNode.innerHTML = `
            <div class="flex items-center">
                <label for="branch" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Chi nhánh</label>
                <input type="text" name="branch" id="branch" class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <input name="rid" type="number" value="${rid}" class="hidden">
            </div>

            <div class="flex items-center">
                <label for="location" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Địa điểm</label>
                <input type="text" name="location" id="location" class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div class="flex items-center">
                <label for="description" class="w-1/4 text-lg font-medium text-gray-900 dark:text-white">Mô tả địa điểm</label>
                <textarea name="description" id="description" rows="10" class="w-3/4 p-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>

            <div class="flex justify-end mt-4 space-x-4">
                <button class="px-4 py-2 text-teal-500 transition duration-300 ease-in-out transform border border-teal-500 rounded-lg hover:bg-teal-500 hover:text-white hover:scale-105" type="submit">
                    Thêm địa chỉ
                </button>
            </div>`;
        list.appendChild(newNode);
    }

    // Xử lý hiển thị preview hình ảnh khi chọn file
    document.getElementById('restaurant_image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('preview_image').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>