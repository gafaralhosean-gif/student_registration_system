<?php require_once __DIR__.'/inc/functions.php'; $title='الرئيسية'; require __DIR__.'/inc/header.php'; ?>
<section class="hero-panel mb-4">
  <div class="hero-content">
    <span class="eyebrow">منصة إدارة أكاديمية</span>
    <h1>مرحباً بك في نظام تسجيل الطلاب</h1>
    <p class="hero-lead">إدارة بيانات الطلاب أصبحت أكثر سهولة ووضوحاً. تابع السجلات، ونظّم المعلومات، وأنجز مهامك من مكان واحد.</p>
    <p class="hero-description">يتيح النظام إنشاء حساب، تسجيل الدخول، وإضافة بيانات الطلاب وعرضها والبحث عنها وتعديلها وحذفها.</p>
    <div class="hero-actions"><?php if(is_logged_in()): ?><a class="btn btn-primary btn-lg" href="<?=BASE_URL?>/students/index.php">استعراض الطلاب <span aria-hidden="true">←</span></a> <a class="btn btn-light btn-lg" href="<?=BASE_URL?>/students/add.php">إضافة طالب</a><?php else: ?><a class="btn btn-primary btn-lg" href="<?=BASE_URL?>/register.php">إنشاء حساب جديد</a> <a class="btn btn-light btn-lg" href="<?=BASE_URL?>/login.php">تسجيل الدخول</a><?php endif; ?></div>
  </div>
  <div class="hero-art" aria-hidden="true"><div class="art-orbit orbit-one"></div><div class="art-orbit orbit-two"></div><div class="art-card"><span class="art-icon">✦</span><strong>إدارة ذكية</strong><small>كل بياناتك في مكان واحد</small><div class="art-bars"><i></i><i></i><i></i><i></i></div></div></div>
</section>
<div class="section-heading"><span class="eyebrow">مميزات النظام</span><h2>كل ما تحتاجه لإدارة سجلات الطلاب</h2></div>
<div class="row g-3 feature-grid">
  <div class="col-md-4"><div class="feature h-100"><span class="feature-icon">01</span><h3>إدارة الطلاب</h3><p>إضافة البيانات وتعديلها وحذفها مع تأكيد الحذف.</p></div></div>
  <div class="col-md-4"><div class="feature h-100"><span class="feature-icon">02</span><h3>البحث والترقيم</h3><p>بحث بالاسم أو البريد أو الهاتف وعرض 10 سجلات في كل صفحة.</p></div></div>
  <div class="col-md-4"><div class="feature h-100"><span class="feature-icon">03</span><h3>الأمان والتحقق</h3><p>تجزئة كلمات المرور، استعلامات محضرة، جلسات وAJAX.</p></div></div>
</div>
<?php require __DIR__.'/inc/footer.php'; ?>