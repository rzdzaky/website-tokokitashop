<!-- Main Content -->
      <div class="main-content">
        <section class="section">
        
		  <div class="row">
		  <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
             
                  <div class="card-body">
                    <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                      <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                      </ol>
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="<?php echo base_url('assets/slide/0bbcb806d558cc4f4167a52436dc462f.jpg');?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="<?php echo base_url('assets/slide/a68b78e8b01370e2746ee57146ddea73.jpg');?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="<?php echo base_url('assets/slide/dbdd846c56cabe865f9482c0f8fb468d.jpg');?>" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
				</div>
				</div>
        
          <div class="section-body">
            <h2 class="section-title">Articles</h2>
            <p class="section-lead">This article component is based on card and flexbox.</p>

            <div class="row">

                <?php foreach ($produk as $key => $value) {
                ?>
                
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article h-100">
                        <div class="article-header">
                            <div class="article-image" data-background="<?php echo base_url('assets/produk/'.$value->foto) ?>">
                            </div>
                            <div class="article-title">
                            <h2><a href="#"><?php echo $value->namaProduk ?></a></h2>
                            </div>
                        </div>
                        <div class="article-details" style="height: 170px">
                            <h5>Rp. <?php echo $value->harga ?></h5>
                            <p><?php echo $value->deskripsiProduk ?></p>
                        </div>
                        <div class="p-2">
                            <a href="<?php echo site_url('cart/add_to_cart/'.$value->idProduk) ?>" class="btn btn-primary w-100 mb-2">Tambah ke cart</a>
                            <a href="<?php echo site_url('home/produk/'.$value->idProduk) ?>" class="btn btn-primary w-100">Detail</a>
                        </div>
                    </article>
                </div>

                <?php
                } ?>
                </div>

            </div>

          </div>
        </section>
      </div>