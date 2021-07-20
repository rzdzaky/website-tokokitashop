<div class="main-content">
<section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="w-100">
            <div class="card card-primary">
              <div class="card-header"><h4>Keranjang</h4></div>

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

              <div class="table-responsive table-invoice">
                    <table class="table table-striped">
                      <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Action</th>
                      </tr>

                    <?php $n = 0; ?>
                    <?php foreach ($cart_items as $item) {?>
                    <?php $n++ ?>
                        <tr>
                            <td><?php echo $n ?></td>
                            <td class="font-weight-600"><?php echo $item['name'] ?></td>
                            <td><?php echo $item['price'] ?></td>
                            <td class="w-100 d-flex justify-content-around align-items-center">
                                <a href="<?php echo site_url('cart/remove_one_qty/'.$item['rowid']) ?>">
                                    <button class="btn btn-danger btn-sm">-</button>
                                </a>
                                <?php echo $item['qty'] ?>
                                <a href="<?php echo site_url('cart/add_one_qty/'.$item['rowid']) ?>">
                                    <button class="btn btn-primary btn-sm">+</button>
                                </a>
                            </td>
                            <td>
                            <a href="<?php echo site_url('cart/delete_cart/'.$item['rowid']) ?>" class="btn btn-danger">Hapus</a>
                            </td>
                        </tr>
                    <?php
                    } ?>

                    </table>
                    <strong>Total : Rp. <?php echo $total ?></strong>
                      <a href="<?php echo site_url('cart/checkout') ?>" class="float-right">
                        <button class="btn btn-primary">
                          checkout
                        </button>
                      </a>
                  </div>

              </div>
          </div>
        </div>
      </div>
</section>
</div>