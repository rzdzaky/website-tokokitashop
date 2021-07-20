<div class="main-content">
                
<section class="section">
            <div class="section-header">
                <div class="section-header-back">
                <a href="<?php echo base_url('home');?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Mencari: "<?php echo $q ?>"</h1>
            
            </div>

            <div class="section-body">
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

                <?php 
                    echo $this->pagination->create_links();
                ?>
            </div>
      	</section>
</div>