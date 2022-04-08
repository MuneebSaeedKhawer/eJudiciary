<div class="row">
  <div class="col-lg-4 col-12">
    <div class="small-box bg-info">
      <div class="inner">
        <h3><?php
    $result = $conn->query("SELECT id from `cases`");
    $row_cnt = $result->num_rows;
    echo $row_cnt;
	 ?></h3>
        <p>Total Case(s)</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      </a>
    </div>
  </div>
  
  <div class="col-lg-4 col-12">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?php
    $result = $conn->query("SELECT id from `cases` where case_status != 'closed'");
    $row_cnt = $result->num_rows;
    echo $row_cnt;
	 ?></h3>
        <p>Active Case(s)</p>
      </div>
      <div class="icon">
        <i class="ion ion-person-add"></i>
      </div>
      </a>
    </div>
  </div>
  <div class="col-lg-4 col-12">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3><?php
    $result = $conn->query("SELECT id from `cases` where case_status = 'closed'");
    $row_cnt = $result->num_rows;
    echo $row_cnt;
	 ?></h3>
        <p>Closed Case(s)</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      </a>
    </div>
  </div>
</div>