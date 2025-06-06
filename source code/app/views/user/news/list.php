


<div class="container py-5">
<nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
  <div class="container">
    <ol class="py-3 mb-0 breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
          <i class="bi bi-house-door-fill me-1"></i>Trang chủ
        </a>
      </li>
      <li class="breadcrumb-item active">
        <i class="bi bi-newspaper me-1"></i>Tin tức
      </li>
    </ol>
  </div>
</nav>
  <!-- Header Section -->
  <div class="mb-5 text-center">
    <h2 class="text-uppercase fw-bold position-relative d-inline-block" style="color: #2c3e50;">
      <?php echo $data['heading'] ?>
      <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
    </h2>
  </div>

  <!-- News List -->
  <div class="row g-4">
    <?php if ($data['news']) {
      foreach ($data['news'] as $news) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100" style="border: none; box-shadow: 0 3px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
            <div class="overflow-hidden position-relative" style="height: 250px;">
              <img src="<?php echo $news['news_image'] ?>" class="card-img-top w-100 h-100 object-fit-cover" style="transition: all 0.3s ease;">
            </div>
            <div class="p-4 card-body">
              <h5 class="mb-3 card-title fw-bold" style="color: #2c3e50;">
                <?php echo $news['title'] ?>
              </h5>
              <p class="mb-4 card-text" style="color: #666; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                <?php echo $news['header'] ?>
              </p>
              <a href="<?php echo $path ?>user/news/detail_news/<?php echo $news['nsid'] ?>" class="btn w-100" 
                 style="background: #e74c3c; color: white; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                <i class="bi bi-arrow-right-circle me-2"></i>Xem chi tiết
              </a>
            </div>
          </div>
        </div>
    <?php }} else { ?>
      <div class="py-5 text-center col-12">
        <i class="bi bi-inbox display-1" style="color: #95a5a6;"></i>
        <p class="mt-3" style="color: #7f8c8d;">Không tìm thấy kết quả phù hợp</p>
      </div>
    <?php } ?>
  </div>

  <!-- Pagination -->
  <?php if ($data['news']) { ?>
    <nav class="mt-5" aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($data['currentPage'] == 1) echo 'disabled' ?>">
          <a class="page-link" href="<?php echo $path ?>user/news/list_news/<?php echo $data['currentPage'] - 1 ?>/<?php echo $data['search'] ?>">
            <i class="bi bi-chevron-left"></i>
          </a>
        </li>
        
        <?php for ($i = 1; $i <= $data['maxPage']; $i++) { ?>
          <li class="page-item <?php if ($i == $data['currentPage']) echo 'active' ?>">
            <a class="page-link" <?php if ($i != $data['currentPage']) { ?> 
               href="<?php echo $path ?>user/news/list_news/<?php echo $i ?>/<?php echo $data['search'] ?>"
               <?php } ?>><?php echo $i ?></a>
          </li>
        <?php } ?>

        <li class="page-item <?php if ($data['currentPage'] == $data['maxPage']) echo 'disabled' ?>">
          <a class="page-link" href="<?php echo $path ?>user/news/list_news/<?php echo $data['currentPage'] + 1 ?>/<?php echo $data['search'] ?>">
            <i class="bi bi-chevron-right"></i>
          </a>
        </li>
      </ul>
    </nav>
  <?php } ?>
</div>

<style>
.card:hover {
  transform: translateY(-5px);
}

.card:hover img {
  transform: scale(1.05);
}

.page-link {
  color: #e74c3c;
  border: none;
  padding: 8px 16px;
  margin: 0 4px;
}

.page-link:hover,
.page-link:focus {
  color: #e74c3c;
  background: rgba(231, 76, 60, 0.1);
}

.page-item.active .page-link {
  background: #e74c3c;
  border-color: #e74c3c;
}

.page-item.disabled .page-link {
  color: #95a5a6;
}
</style>

<?php
// Thông tin SEO cho Trang Danh Sách Tin Tức/Blog - Nhà hàng Buffet 5SR
$pageSpecificTitle = "Tin Tức Ẩm Thực & Sự Kiện Mới Nhất | Blog Nhà Hàng Buffet 5SR";
$pageSpecificDescription = "Cập nhật những tin tức nóng hổi, sự kiện ẩm thực đặc sắc, các chương trình khuyến mãi hấp dẫn và bí quyết thưởng thức buffet từ chuyên gia tại Nhà hàng Buffet 5SR.";
$pageSpecificKeywords = "blog ẩm thực buffet 5sr, tin tức nhà hàng 5sr, sự kiện ẩm thực tphcm, khuyến mãi buffet mới nhất, mẹo ăn buffet ngon";
$pageSpecificOgImage = "https://restaurant-dth.s3.ap-southeast-2.amazonaws.com/og-images/news.jpg";
$ogType= 'restaurant:articles';
$ogSiteName = "Nhà hàng Buffet 5SR"; // Tên trang web hoặc nhà hàng
?>