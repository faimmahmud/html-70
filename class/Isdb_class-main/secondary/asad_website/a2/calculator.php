<?php
$pageTitle = 'Tools | Aurelia Estates';
require_once __DIR__ . '/includes/header.php';
?>
<section class="py-5">
  <div class="container">
    <div class="mb-4">
      <span class="badge badge-soft rounded-pill">Smart tools</span>
      <h1 class="section-title mt-2">EMI and construction cost estimator</h1>
      <p class="text-secondary mb-0">Use this for pricing, planning, and budget checks.</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-6">
        <div class="tool-card h-100">
          <h4>EMI calculator</h4>
          <form id="emiForm" class="row g-3 mt-2">
            <div class="col-12"><input id="emiPrice" type="number" class="form-control" value="250000" placeholder="Property price"></div>
            <div class="col-md-4"><input id="emiDown" type="number" class="form-control" value="50000" placeholder="Down payment"></div>
            <div class="col-md-4"><input id="emiRate" type="number" class="form-control" value="10" placeholder="Interest %"></div>
            <div class="col-md-4"><input id="emiMonths" type="number" class="form-control" value="240" placeholder="Months"></div>
          </form>
          <div class="mt-4 p-3 rounded-4 surface soft">Estimated EMI: <strong>$<span id="emiResult">0.00</span></strong></div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="tool-card h-100">
          <h4>Construction cost estimator</h4>
          <form id="costForm" class="row g-3 mt-2">
            <div class="col-12"><input id="costSqft" type="number" class="form-control" value="1500" placeholder="Total sqft"></div>
            <div class="col-md-4"><input id="cementRate" type="number" class="form-control" value="10" placeholder="Cement"></div>
            <div class="col-md-4"><input id="brickRate" type="number" class="form-control" value="12" placeholder="Bricks"></div>
            <div class="col-md-4"><input id="sandRate" type="number" class="form-control" value="8" placeholder="Sand"></div>
            <div class="col-md-6"><input id="rodRate" type="number" class="form-control" value="18" placeholder="Rod"></div>
            <div class="col-md-6"><input id="laborRate" type="number" class="form-control" value="14" placeholder="Labor"></div>
          </form>
          <div class="mt-4 p-3 rounded-4 surface soft">Estimated total: <strong>$<span id="costResult">0</span></strong></div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
