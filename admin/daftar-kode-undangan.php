<?php
session_start();
require '../config.php';
require '../library/session_login_admin.php'; 
require '../library/header_admin.php';
?>

        <!-- Start Sub Header -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
	        <div class="kt-container ">
	            <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">Daftar Aktifitas Kode Undangan</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="#" class="kt-subheader__breadcrumbs-link">Halaman Admin</a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="#" class="kt-subheader__breadcrumbs-link">Daftar Aktifitas Kode Undangan</a>
	                </div>
	            </div>
	        </div>
        </div>
        <!-- End Sub Header -->

        <!-- Start Content -->
        <div class="kt-container kt-grid__item kt-grid__item--fluid">

        <!-- Start Page Data Code Reffreal -->
        <div class="row">
	        <div class="col-lg-12">
		        <div class="kt-portlet">
			        <div class="kt-portlet__head">
				        <div class="kt-portlet__head-label">
					        <h3 class="kt-portlet__head-title">
					            <i class="fa fa-key text-primary"></i>
					            Daftar Aktifitas Kode Undangan
					        </h3>
				        </div>
			        </div>
			        <div class="kt-portlet__body">
                    <form class="form-horizontal" method="GET">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label>Tampilkan Beberapa</label>
                                <select class="form-control" name="tampil">
                                    <option value="10">Default</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>                                             
                            <div class="form-group col-lg-4">
                                <label>Cari Kode Undangan</label>
                                <input type="text" class="form-control" name="search" placeholder="Cari Kode Undangan">
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Submit</label>
                                <button type="submit" class="btn btn-block btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-striped- table-bordered table-hover table-checkable" id="kt_table_1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Uplink</th>
                                    <th>Level</th>
                                    <th>Kode</th>
                                    <th>Saldo Sosial Media</th>
                                    <th>Saldo Top Up</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
<?php 
// start paging config
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $tampil = $conn->real_escape_string(filter($_GET['tampil']));

    $cek_data = "SELECT * FROM kode_undangan WHERE kode LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
    $cek_data = "SELECT * FROM kode_undangan ORDER BY id DESC"; // edit
}
if (isset($_GET['search'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['tampil']));
$records_per_page = $cari_urut; // edit
} else {
    $records_per_page = 10; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = ($conn->real_escape_string(filter($_GET["halaman"]))-1) * $records_per_page;
}
$new_query = $cek_data." LIMIT $starting_position, $records_per_page";
$new_query = $conn->query($new_query);
$no = $starting_position+1;
// end paging config
while ($datanya = $new_query->fetch_assoc()) {
    if ($datanya['status'] == "Belum Dipakai") {
        $label = "success";
    } else if ($datanya['tipe'] == "Sudah Dipakai") {
        $label = "primary";
    }
?>
                                <tr>
                                    <td width="3%"><span class="badge badge-dark"><?php echo $no++; ?></span></td>
                                    <td><?php echo tanggal_indo($datanya['date']); ?>, <?php echo $datanya['time']; ?></span></td>
                                    <td width="10%"><span class="badge badge-primary"><?php echo $datanya['uplink'] ?></span></td>
                                    <td width="7%"><span class="badge badge-success"><?php echo $datanya['level']; ?></span></td>
                                    <td width="7%"><span class="badge badge-warning"><?php echo $datanya['kode']; ?></span></td>
                                    <td width="15%"><span class="badge badge-danger">Rp <?php echo number_format($datanya['saldo_sosmed'],0,',','.'); ?></span></td>
                                    <td width="15%"><span class="badge badge-info">Rp <?php echo number_format($datanya['saldo_top_up'],0,',','.'); ?></span></td>
                                    <td width="10%"><span class="badge badge-dark"><?php echo $datanya['status']; ?></span></td>
                                </tr>   
<?php } ?>
                            </tbody>
                        </table>
                        <br>
                            <div class="kt-pagination kt-pagination--brand kt-pagination--circle">
                                <ul class="kt-pagination__links">
<?php
// start paging link
if (isset($_GET['search'])) {
$cari_urut = $conn->real_escape_string(filter($_GET['search']));
} else {
$cari_urut =  10;
}  
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $tampil = $conn->real_escape_string(filter($_GET['tampil']));
} else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_data = $conn->query($cek_data);
$total_records = mysqli_num_rows($cek_data);
echo "<li class='page-item disabled'><a href='#'>Total Data : ".$total_records."</a></li>";
if($total_records > 0) {
    $total_pages = ceil($total_records/$records_per_page);
    $current_page = 1;
    if(isset($_GET["halaman"])) {
        $current_page = $conn->real_escape_string(filter($_GET["halaman"]));
        if ($current_page < 1) {
            $current_page = 1;
        }
    }
    if($current_page > 1) {
        $previous = $current_page-1;
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));

        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=1&tampil=".$tampil."&search=".$search."'><i class='fa fa-angle-double-left kt-font-brand'></i></a></li>";
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$previous."&tampil=".$tampil."&search=".$search."'><i class='fa fa-angle-left kt-font-brand'></i></a></li>";
} else {
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=1'><i class='fa fa-angle-double-left kt-font-brand'></i></a></li>";
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$previous."'><i class='fa fa-angle-left kt-font-brand'></i></a></li>";
}
}
    // limit page
    $limit_page = $current_page+3;
    $limit_show_link = $total_pages-$limit_page;
    if ($limit_show_link < 0) {
        $limit_show_link2 = $limit_show_link*2;
        $limit_link = $limit_show_link - $limit_show_link2;
        $limit_link = 3 - $limit_link;
    } else {
        $limit_link = 3;
    }
    $limit_page = $current_page+$limit_link;
    // end limit page
    // start page
    if ($current_page == 1) {
        $start_page = 1;
    } else if ($current_page > 1) {
        if ($current_page < 4) {
            $min_page  = $current_page-1;
        } else {
            $min_page  = 3;
        }
        $start_page = $current_page-$min_page;
    } else {
        $start_page = $current_page;
    }
    // end start page
    for($i=$start_page; $i<=$limit_page; $i++) {
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $tampil = $conn->real_escape_string(filter($_GET['tampil']));
        if($i==$current_page) {
            echo "<li class='kt-pagination__link--active'><a href='#'>".$i."</a></li>";
        } else {
            echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$i."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'>".$i."</a></li>";
        }
    } else {
        if($i==$current_page) {
            echo "<li class='kt-pagination__link--active'><a href='#'>".$i."</a></li>";
        } else {
            echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$i."'>".$i."</a></li>";
        }        
    }
    }
    if($current_page!=$total_pages) {
        $next = $current_page+1;
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string(filter($_GET['search']));
    $tampil = $conn->real_escape_string(filter($_GET['tampil']));

        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$next."&tampil=".$tampil."&search=".$search."'><i class='fa fa-angle-right kt-font-brand'></i></a></li>";
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$total_pages."&tampil=".$tampil."&search=".$search."'><i class='fa fa-angle-double-right kt-font-brand'></i></a></li>";
} else {
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$next."'><i class='fa fa-angle-right kt-font-brand'></i></a></li>";
        echo "<li class='kt-pagination__link--first'><a href='".$self."?halaman=".$total_pages."'><i class='fa fa-angle-double-right kt-font-brand'></i></a></li>";
    }
}
}
// end paging link
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Data Activity Code Reffreal -->

        </div>
        <!-- End Content -->

        <!-- Start Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
		    <i class="fa fa-arrow-up"></i>
		</div>
		<!-- End Scrolltop -->

<?php
require '../library/footer_admin.php';
?>