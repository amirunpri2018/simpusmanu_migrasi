<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>S. I. M | Politeknik Pusmanu</title>
        <link href='<?php echo base_url("assets/images/favicon.ico"); ?>' rel='shortcut icon' type='image/x-icon'/>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Rifka Aga Saputra" />
        <link rel="shortcut icon" href="">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/font-awesome.min.css"); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/demo.css"); ?>" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/component.css"); ?>" />
        <!-- Modernizr is used for flexbox fallback -->
        <script src="<?php echo base_url("assets/js/modernizr.custom.js"); ?>"></script>
    </head>
    <body>
        <!-- Main view -->
        <div class="view">
            <!-- Blueprint header -->
            <header class="bp-header cf">
                <span><img class="image" src="<?php echo base_url("assets/images/Logo-pusmanu.png"); ?>" /></span>
                <h1>S. I. M. POLITEKNIK PUSMANU</h1>

            </header>
            <!-- Product grid -->
            <section class="grid">
                <!-- Products -->
                <div class="product">
                    <div class="product__info">
                        <img class="product__image" src="<?php echo base_url("assets/images/icon-sarjana.png"); ?>" alt="Product 4" />
                        <h3 class="product__title">SIAKAD</h3>
                        <span class="product__price highlight">Login SIAKAD</span>
                        <a href="http://siakad.politeknikpusmanu.ac.id" target="_blank">
                            <button class="action action--button action--buy"><i class="fa fa-paper-plane-o"></i><span class="action__text">LINK</span></button>
                        </a>
                    </div>

                </div>
                <div class="product">
                    <div class="product__info">
                        <img class="product__image" src="<?php echo base_url("assets/images/human.png"); ?>" alt="Product 1" />
                        <h3 class="product__title">SIMPEG</h3>
                        <span class="product__price highlight">Login SIMPEG</span>
                        <a href="<?php echo base_url("auth/login/simpeg"); ?>" >
                            <button class="action action--button action--buy"><i class="fa fa-paper-plane-o"></i><span class="action__text">LINK</span></button>
                        </a>
                    </div>
                </div>
                <div class="product">
                    <div class="product__info">
                        <img class="product__image" src="<?php echo base_url("assets/images/icon-surat.png"); ?>" alt="Product 2" />
                        <h3 class="product__title">INFORMASI PERSURATAN</h3>
                        <span class="product__price highlight">Login SIP</span>
                        <a href="<?php echo base_url("auth/login/sip"); ?>" >
                            <button class="action action--button action--buy"><i class="fa fa-paper-plane-o"></i><span class="action__text">LINK</span></button>
                        </a>
                    </div>
                </div>
                <div class="product">
                    <div class="product__info">
                        <img class="product__image" src="<?php echo base_url("assets/images/icon-aset.png"); ?>" alt="Product 3" />
                        <h3 class="product__title">MANAJEMEN ASSET </h3>
                        <span class="product__price highlight">Login SIMA</span>
                        <a href="<?php echo base_url("auth/login/sima"); ?>" >
                            <button class="action action--button action--buy"><i class="fa fa-paper-plane-o"></i><span class="action__text">LINK</span></button>
                        </a>
                    </div>

                </div>
                <div class="product">
                    <div class="product__info">
                        <img class="product__image" src="<?php echo base_url("assets/images/icon-library.png"); ?>" alt="Product 4" />
                        <h3 class="product__title">LIBRARY MANAGEMENT</h3>
                        <span class="product__price highlight">Login SLIMS</span>
                        <a href="http://lib.politeknikpusmanu.ac.id" target="_blank">
                            <button class="action action--button action--buy"><i class="fa fa-paper-plane-o"></i><span class="action__text">LINK</span></button>
                        </a>
                    </div>

                </div>

            </section>
        </div>
    </body>
</html>
