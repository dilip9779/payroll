<?php
defined('BASEPATH') OR exit('No direct script access allowed'); 
?>
<main>
	<div class="container-fluid">
		<h1 class="mt-4">District</h1>
		<ol class="breadcrumb mb-4">
			<li class="breadcrumb-item"><a href="<?=base_url()?>">Dashboard</a></li>
			<li class="breadcrumb-item active">District</li>
		</ol>
		<div class="card mb-4">
        <div class="card-header">
                    <i class="fa fa-table"></i> District<a href="<?=base_url()?>master/district/add"><button class="btn btn-primary right">+</button></a>
                </div>
			<div class="card-body">
            <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>State</th>
                                    <th>District Code</th>
                                    <th>District Name</th>
                                    <th>Action</th> 
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>State</th>
                                    <th>District Code</th>
                                    <th>District Name</th>
                                    <th>Action</th> 
                                </tr>
                            </tfoot>
                            <tbody>
                            <?php  foreach ($district as $v) { ?>
                                <tr>
                                    <td><?=$v["state_name_eng"]?></td>
                                    <td><?=$v["district_code_census"]?></td>
                                    <td><?=$v["district_name_english"]?></td>
                                    <td><form method="POST" action="" style="display:inline;"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?=$v["state_code_census"]?>"><input type="submit" class="btn btn-primary" value="Delete"></form> <a href="<?=base_url()?>settings/admins/edit/<?=$v["state_code_census"]?>"><button class="btn btn-primary">Edit</button></a> </td>
                                </tr>
                            <?php } ?> 
                            </tbody>
                        </table>
                    </div>           
            </div>
		</div>
	</div>
</main>