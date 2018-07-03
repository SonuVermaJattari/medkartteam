<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.product-image-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    display: none;
}

.product-image-overlay .product-image-overlay-close {
    display: block;
    position: absolute;
    top: 20px;
    left: 20px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 1px solid #eee;
    line-height: 35px;
    font-size: 20px;
    color: #eee;
    text-align: center;
    cursor: pointer;
}

.product-image-overlay img {
    width: auto;
    max-width: 80%;
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -moz-transform: translate(-50%, -50%);
    -o-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
</head>

<body>
<img src="http://www.outlier.com/sites/www.outlier.com/files/styles/large/public/science-social-media.png?itok=pvP5t1iF">
<img src="http://www.outlier.com/sites/www.outlier.com/files/styles/large/public/science-social-media.png?itok=pvP5t1iF">
</body>
<script>
$('body').append('<div class="product-image-overlay"><span class="product-image-overlay-close">x</span><img src="" /></div>');
var productImage = $('img');
var productOverlay = $('.product-image-overlay');
var productOverlayImage = $('.product-image-overlay img');

productImage.click(function () {
    var productImageSource = $(this).attr('src');

    productOverlayImage.attr('src', productImageSource);
    productOverlay.fadeIn(100);
    $('body').css('overflow', 'hidden');

    $('.product-image-overlay-close').click(function () {
        productOverlay.fadeOut(100);
        $('body').css('overflow', 'auto');
    });
});
</script>
</html>
