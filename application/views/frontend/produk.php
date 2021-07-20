<div class="main-content">
                
<section class="section">
            <div class="section-header">
                <div class="section-header-back">
                <a href="<?php echo base_url('home');?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail produk</h1>
            
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                    <div class="card-header">
                        <h4>Foto</h4>
                    </div>
                    <div class="card-body">
                        <img src="<?php echo base_url('assets/produk/'.$produk->foto) ?>" style="object-fit: contain; width: 100%" alt="logo-toko"> 
                    </div>
                    </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6">
                    <div class="card">
                            <div class="card-header">
                                <h4>Informasi Produk</h4>
                            </div>
                            <div class="card-body p-4">
                                <h5><?php echo $produk->namaProduk ?></h5>
                                <p>Harga Rp. <?php echo $produk->harga ?></p>
                                <h6>Stok <?php echo $produk->stok ?> item</h6>
                                <hr>
                                <h6 class="mt-5">Detail produk</h6>
                                <p><?php echo $produk->deskripsiProduk ?></p>
                                <a href="<?php echo site_url('cart/add_to_cart/'.$produk->idProduk) ?>" class="btn btn-primary w-100 mb-2">Tambah ke cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card w-100">
                        <div class="card-header">
                            <h4>Komentar</h4>
                        </div>
                        
                        <div class="card-body">
                            <form action="<?php echo site_url('member/tambah_komentar/'.$produk->idProduk) ?>" method="post">
                                <div class="form-group">
                                    <label>Isi komentar anda</label>
                                    <input type="text" class="form-control" style="max-width: 100%;" name="komentar">
                                </div>
                                <button class="btn btn-primary">Kirim komentar</button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                <?php foreach ($komentar as $key => $value) {
                ?>
                <div class="card w-100">
                    <div class="card-body">
                        <div class="p-2 mb-2">
                            <div class="w-100 d-flex justify-content-between">
                                <h5>oleh "<?php echo $value->namaKonsumen ?>"</h5>
                                <p><?php echo $value->tanggal ?></p>
                            </div>
                            <p class="mt-2"><?php echo $value->komentar ?></p>
                        </div>
                    </div>
                </div>
                    <?php if ($key == 5) {
                        break;
                    }?>
                <?php
                } ?>
                </div>
            </div>
      	</section>
</div>