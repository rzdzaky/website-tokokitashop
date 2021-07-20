<div class="main-content">
<section class="section">
          <div class="section-header">
            <div class="section-header-back">
              <a href="<?php echo site_url('home/menu');?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Menu Utama Dashboard Member</h1>
          </div>

            <div class="card-body">
              <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
              <?php endif; ?>

              <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
              <?php endif; ?>

          <div class="section-body">
            <div id="output-status"></div>
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <h4>Menu Toko <strong>" <?php echo $toko->namaToko ?> "</strong></h4>
                  </div>
                  <div class="card-body">
               <ul class="nav nav-pills flex-column">
                      <li class="nav-item"><a href="<?php echo site_url('toko/detail/'.$toko->idToko);?>" class="nav-link">Beranda</a></li>
                      <li class="nav-item"><a href="<?php echo site_url('toko/edit/'.$toko->idToko);?>" class="nav-link">Edit</a></li>
                      <li class="nav-item"><a href="<?php echo site_url('toko/produk/'.$toko->idToko);?>" class="nav-link">Produk</a></li>
                      <li class="nav-item"><a href="<?php echo site_url('toko/pesanan');?>" class="nav-link">Pesanan</a></li>
                      <li class="nav-item"><a href="<?php echo site_url('toko/laporan');?>" class="nav-link">Laporan</a></li>
                    </ul>
                  </div>
                </div>
              </div>
	
              <div class="col-md-8">
					<div class="row">
              <div class="col-12">
                <div class="card mb-0">
                  <div class="card-body">
                    <ul class="nav nav-pills">
                      <li class="nav-item">
                        <a class="nav-link active" href="<?php echo site_url('toko/create_produk/'.$toko->idToko);?>">Silakan Membuat Produk</a>
                      </li>
               
                    </ul>
                  </div>
                </div>
              </div>
            </div><br>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Data Toko</h4>
                  <div class="card-header-action">
                   
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Nama produk</th>
                          <th>Kategori</th>
                          <th>Foto</th>
                          <th>stok</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($produk as $key => $value) {
                      ?>
                        <tr>
                          <td><?php echo $value->namaProduk ?></td>
                          <td class="font-weight-600"><?php echo $value->namakat ?></td>
                          <td>
                          <img src="<?php echo base_url('assets/produk/'.$value->foto) ?>" style="object-fit: contain" alt="logo-toko-<?php echo $value->namaProduk?>" width="75" height="75"> 
                          </td>
                          <td><?php echo $value->stok ?></td>
                          
                          <td>
                            <a href="<?php echo site_url('/toko/edit_produk/'.$value->idProduk); ?>" class="btn btn-primary">Edit</a>
                            <a href="<?php echo site_url('/toko/hapus_produk/'.$value->idProduk); ?>" class="btn btn-danger">Hapus</a>
                          </td>
                        </tr>
                      <?php
                      } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              </div>

			
            </div>
  		    </div>
      	</section>
      
</div>