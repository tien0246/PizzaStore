<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Báo cáo Đơn Hàng và Món Ăn</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(
            rgba(50, 50, 50, 0.5),
            rgba(50, 50, 50, 0.5)
          ),
          url("https://t3.ftcdn.net/jpg/05/64/32/70/360_F_564327039_eHOuKCz4S0BZbVbLrdnIj4cSlZimBIe7.jpg")
            fixed;
        background-size: cover;
        color: #333;
        margin: 0;
        padding: 0;
      }

      /* Container Adjustments */
      .container-fluid {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        padding: 20px;
      }

      .date-container {
        flex: 1 1 35%;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
      }
      .food-container {
        flex: 1 1 45%;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
      }

      .page-title {
        color: #2c3e50;
        font-weight: bold;
        text-transform: uppercase;
        text-align: center;
        margin-bottom: 20px;
      }

      .page-title span {
        color: #e74c3c; 
      }

      .report-header {
        background-color: #34495e;
        color: #ecf0f1;
        font-weight: bold;
        border-radius: 8px 8px 0 0;
        padding: 12px 0;
      }

      .report-row {
        background-color: #ecf0f1;
        border-bottom: 1px solid #bdc3c7;
        color: #2c3e50;
        padding: 10px 0;
        transition: background-color 0.3s, transform 0.3s;
      }

      .report-row:hover {
        background-color: #dfe6e9;
        transform: scale(1.02);
      }

      .report-row li {
        padding: 8px 0;
        text-align: center;
      }

      .btn-primary {
        background-color: #2980b9;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
      }

      .btn-primary:hover {
        background-color: #1f6391;
      }

      .form-check-input {
        margin-right: 8px;
      }

      .food-name::before {
        content: "🍕";
        margin-right: 8px;
      }

      @media (max-width: 768px) {
        .container-fluid {
          flex-direction: column;
        }

        .date-container,
        .food-container {
          flex: 1 1 100%;
        }
      }
    </style>
</head>
<body>
    <div class="container-fluid mt-4 pb-5">
        <div class="date-container" id="reportDateContainer">
            <h2 class="mb-4 page-title">
                <span class="me-2">🍕</span>
                Báo cáo theo đơn
                <span class="ms-2">🍕</span>
            </h2>
            <div class="card shadow-none">
                <div class="card-body px-4">
                    <form method="GET" action="" class="mb-4">
                        <input type="hidden" name="controller" value="report">
                        <input type="hidden" name="action" value="index">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortDateForDate" value="date" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'date') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortDateForDate">Ngày</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortOrderIdForDate" value="orderId" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'orderId') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortOrderIdForDate">Mã đơn</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortTotalMoneyForDate" value="totalMoney" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'totalMoney') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortTotalMoneyForDate">Tổng tiền</label> 
                            </div>
                            <button type="submit" class="btn btn-primary">Sắp xếp</button>
                        </div>
                    </form>
                    <ul class="row report-list report-header">
                        <li class="col-sm-4 text-center">Ngày</li>
                        <li class="col-sm-4 text-center">Mã đơn</li>
                        <li class="col-sm-4 text-center">Tổng tiền</li>
                    </ul>
                    <?php if (!empty($reportDataForDate)): ?>
                        <?php foreach ($reportDataForDate as $report): ?>
                            <ul class="row report-row">
                                <li class="col-sm-4 text-center"><?php echo htmlspecialchars($report['orderDate']); ?></li>
                                <li class="col-sm-4 text-center"><?php echo htmlspecialchars($report['orderId']); ?></li>
                                <li class="col-sm-4 text-center"><?php echo htmlspecialchars($report['totalMoney']); ?></li>
                            </ul>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Không có dữ liệu báo cáo.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Food Report Section -->
        <div class="food-container" id="reportFoodContainer">
            <h2 class="mb-4 page-title">
                <span class="me-2">🍕</span>
                Báo cáo theo món
                <span class="ms-2">🍕</span>
            </h2>
            <div class="card shadow-none">
                <div class="card-body px-4">
                <form method="GET" action="" class="mb-4">
                        <input type="hidden" name="controller" value="report">
                        <input type="hidden" name="action" value="index">
                        <div class="d-flex justify-content-center align-items-center gap-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortDateForFood" value="date" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'date') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortDateForFood">Ngày</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortOrderIdForFood" value="orderId" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'orderId') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortOrderIdForFood">Mã đơn</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortFoodNameForFood" value="foodName" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'foodName') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortFoodNameForFood">Tên món</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortQuantityForFood" value="quantity" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'quantity') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortQuantityForFood">Số lượng</label>
                            </div>  
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortPriceForFood" value="price" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'price') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortPriceForFood">Đơn giá</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sortType" id="sortTotalMoneyForFood" value="totalMoney" <?php if(isset($_GET['sortType']) && $_GET['sortType'] === 'totalMoney') echo 'checked'; ?>>
                                <label class="form-check-label" for="sortTotalMoneyForFood">Thành tiền</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sắp xếp</button>
                        </div>
                    </form>
                    <ul class="row report-list report-header">
                        <li class="col-sm-2 text-center">Ngày</li>
                        <li class="col-sm-2 text-center">Mã đơn</li>
                        <li class="col-sm-2 text-center">Tên món</li>
                        <li class="col-sm-2 text-center">Số lượng</li>
                        <li class="col-sm-2 text-center">Đơn giá</li>
                        <li class="col-sm-2 text-center">Thành tiền</li>
                    </ul>
                    <?php if (!empty($reportDataForFood)): ?>
                        <?php foreach ($reportDataForFood as $report): ?>
                            <ul class="row report-row">
                                <li class="col-sm-2 text-center"><?php echo htmlspecialchars($report['orderDate']); ?></li>
                                <li class="col-sm-2 text-center"><?php echo htmlspecialchars($report['orderId']); ?></li>
                                <li class="col-sm-2 text-center food-name"><?php echo htmlspecialchars($report['foodName']); ?></li>
                                <li class="col-sm-2 text-center"><?php echo htmlspecialchars($report['quantity']); ?></li>
                                <li class="col-sm-2 text-center"><?php echo htmlspecialchars($report['price']); ?></li>
                                <li class="col-sm-2 text-center"><?php echo htmlspecialchars($report['totalMoney']); ?></li>
                            </ul>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center">Không có dữ liệu báo cáo theo món.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>
