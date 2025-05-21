# Dự án Website Thương mại Điện tử

Đây là một dự án website thương mại điện tử được xây dựng nhằm cung cấp một nền tảng mua sắm trực tuyến cho người dùng.

## Tính năng

- **Người dùng:**
  - Đăng ký, đăng nhập tài khoản
  - Xem danh sách sản phẩm
  - Tìm kiếm sản phẩm
  - Xem chi tiết sản phẩm
  - Thêm sản phẩm vào giỏ hàng
  - Quản lý giỏ hàng
  - Đặt hàng
  - Xem lịch sử đơn hàng
  - Quản lý thông tin cá nhân
  - Đánh giá sản phẩm
- **Quản trị viên:**
  - Quản lý sản phẩm (thêm, sửa, xóa)
  - Quản lý danh mục sản phẩm
  - Quản lý đơn hàng
  - Quản lý người dùng
  - Xem thống kê

## Công nghệ sử dụng

- **Ngôn ngữ lập trình:** PHP
- **Framework/Thư viện:**
  - [Tailwind CSS](https://tailwindcss.com/): Framework CSS để xây dựng giao diện người dùng.
  - [AWS SDK cho PHP](https://aws.amazon.com/sdk-for-php/): Để tương tác với các dịch vụ của Amazon Web Services (nếu có).
- **Cơ sở dữ liệu:** (Chưa xác định - cần bổ sung thông tin)
- **Quản lý gói phụ thuộc:**
  - [Composer](https://getcomposer.org/): Dành cho PHP.
  - [NPM](https://www.npmjs.com/)/[Yarn](https://yarnpkg.com/): Dành cho JavaScript (Tailwind CSS).
- **Web server:** (Chưa xác định - ví dụ: Apache, Nginx - cần bổ sung thông tin)

## Cài đặt

1.  **Clone repository:**
    ```bash
    git clone https://your-repository-url.git
    cd Restaurant-Service
    ```
2.  **Cài đặt các gói phụ thuộc PHP:**
    ```bash
    cd "source code"
    composer install
    ```
3.  **Cài đặt các gói phụ thuộc JavaScript và build CSS:**

    ```bash
    # Đảm bảo bạn đã cài đặt Node.js và npm/yarn
    npm install
    # Hoặc
    yarn install

    # Build Tailwind CSS (kiểm tra lại lệnh trong package.json nếu có)
    # Ví dụ:
    npm run build
    # Hoặc
    npx tailwindcss -i ./public/css/input.css -o ./public/css/style.css --watch
    ```

4.  **Cấu hình Web server:**
    - Trỏ thư mục gốc của web server vào thư mục `source code/public`.
    - Đảm bảo `mod_rewrite` (đối với Apache) đã được kích hoạt để xử lý các tệp `.htaccess`.
5.  **Cấu hình cơ sở dữ liệu:**
    - Tạo một cơ sở dữ liệu mới.
    - Import schema cơ sở dữ liệu (nếu có tệp `.sql`).
    - Cập nhật thông tin kết nối cơ sở dữ liệu trong tệp cấu hình của ứng dụng (ví dụ: `source code/app/core/config.php` - cần kiểm tra lại đường dẫn thực tế).
6.  **Truy cập ứng dụng:** Mở trình duyệt và truy cập vào địa chỉ bạn đã cấu hình.

## Cấu trúc thư mục (trong `source code`)

```
.
├── app/                    # Chứa logic chính của ứng dụng (MVC)
│   ├── controllers/        # Controllers xử lý request
│   ├── core/               # Các tệp lõi của framework (ví dụ: Router, Database connection)
│   ├── helpers/            # Các hàm tiện ích
│   ├── models/             # Models tương tác với cơ sở dữ liệu
│   ├── views/              # Views hiển thị giao diện người dùng
│   ├── bridge.php          # (Cần làm rõ chức năng)
│   └── .htaccess           # Cấu hình cho thư mục app
├── public/                 # Thư mục công khai, điểm vào của ứng dụng
│   ├── css/                # Chứa các tệp CSS (bao gồm cả output của Tailwind)
│   ├── img/                # Chứa hình ảnh
│   ├── js/                 # Chứa các tệp JavaScript
│   ├── .htaccess           # Cấu hình cho thư mục public
│   └── index.php           # Điểm vào chính của ứng dụng
├── vendor/                 # Thư mục chứa các gói phụ thuộc được cài đặt bởi Composer
├── .gitignore              # Các tệp và thư mục được Git bỏ qua
├── composer.json           # Khai báo các gói phụ thuộc PHP cho Composer
├── composer.lock           # Ghi lại phiên bản chính xác của các gói phụ thuộc đã cài
├── package.json            # Khai báo các gói phụ thuộc JavaScript cho npm/yarn
├── package-lock.json       # Ghi lại phiên bản chính xác của các gói phụ thuộc JavaScript đã cài (cho npm)
└── tailwind.config.js      # Tệp cấu hình cho Tailwind CSS
```

## Đóng góp

Nếu bạn muốn đóng góp cho dự án, vui lòng làm theo các bước sau:

1.  Fork repository này.
2.  Tạo một nhánh mới cho tính năng hoặc bản sửa lỗi của bạn (`git checkout -b feature/your-feature-name`).
3.  Commit các thay đổi của bạn (`git commit -am 'Add some feature'`).
4.  Push lên nhánh của bạn (`git push origin feature/your-feature-name`).
5.  Tạo một Pull Request mới.

## Giấy phép

Dự án này được cấp phép theo Giấy phép MIT. Xem tệp `LICENSE` (nếu có) để biết thêm chi tiết. (Nếu chưa có tệp LICENSE, bạn có thể tạo một tệp và chọn một giấy phép phù hợp).

---

**Lưu ý:**

- Phần **Công nghệ sử dụng** và **Cài đặt** cần được cập nhật chi tiết hơn về cơ sở dữ liệu và web server đang sử dụng.
- Chức năng của tệp `source code/app/bridge.php` cần được làm rõ.
- Lệnh build Tailwind CSS trong phần **Cài đặt** có thể cần điều chỉnh dựa trên cấu hình trong `package.json`.
- Bạn nên tạo một tệp `LICENSE` cho dự án.
