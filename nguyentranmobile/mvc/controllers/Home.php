<?php

    class Home extends Controller
    {
        protected $productModel;
        protected $promotionModel;
        protected $producerModel;
        protected $customerModel;
        protected $feedback_topicModel;
        protected $feedbackModel;
        protected $paymentModel;
        protected $orderModel;
        
        function __construct()
        {
            $this->productModel = $this->getModel("ProductModel");
            $this->promotionModel = $this->getModel("PromotionModel");
            $this->producerModel = $this->getModel("ProducerModel");
            $this->customerModel = $this->getModel("CustomerModel");
            $this->feedback_topicModel = $this->getModel("Feedback_TopicModel");
            $this->feedbackModel = $this->getModel("FeedbackModel");
            $this->paymentModel = $this->getModel("PaymentModel");
            $this->orderModel = $this->getModel("OrderModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            if(isset($_SESSION['customerPassword']) && isset($_SESSION['customerAccountName']) && isset($_SESSION['customerPasswordAgain']) && isset($_SESSION['customerName']) && isset($_SESSION['customerBirthdate']) 
            && isset($_SESSION['customerPhone']) && isset($_SESSION['customerEmail']) && isset($_SESSION['customerAddress']) && isset($_SESSION['customerSex'])){
                unset($_SESSION["customerAccountName"]);
                unset($_SESSION['customerPassword']);
                unset($_SESSION['customerPasswordAgain']);
                unset($_SESSION['customerName']);
                unset($_SESSION['customerBirthdate']);
                unset($_SESSION['customerPhone']);
                unset($_SESSION['customerEmail']);
                unset($_SESSION['customerAddress']);
                unset($_SESSION['customerSex']);         
            }
            $this->getView("master2",[
                "url"=>$this->getBaseUrl(),
                "Page"=>"HomeView",
                "ProductSearchList" => $this->producerModel->getList(),
                "ProductList" => $this->producerModel->getList(),
                "ListGetSanPham" => $this->productModel->getProduct(),
                "ListGetSanPhamKhuyenMai" => $this->productModel->getPromotionProduct()
            ]);
        }

        function signUp(){
            $this->getView("master4",[
                "url"=>$this->getBaseUrl(),
                "Page"=>"SignUp",
                "ListProducer" => $this->producerModel->getList()
            ]);
        }

        //DangNhap
        function signIn(){
            $this->getView("master4",[//master 4
                "url"=>$this->getBaseUrl(),
                "Page"=>"SignIn",
                "ListProducer" => $this->producerModel->getList()
            ]);
        }

        //AddDangKy
        function signUpRole(){
            if(isset($_POST['btnSignUp'])){
                $customerAccountName = $_POST['txtAccountName'];
                $customerPassword = $_POST['txtPassword'];
                $customerPasswordAgain = $_POST['txtPasswordAgain'];
                $customerName = $_POST['txtName'];
                $customerBirthdate = $_POST['dtBirthdate'];
                $customerPhone = $_POST['txtPhone'];
                $customerEmail = $_POST['txtEmail'];
                $customerAddress = $_POST['txtAddress'];
                $customerSex = $_POST['slSex'];
                $customerAuthorization = 1;

                $_SESSION["customerAccountName"] = $customerAccountName;
                $_SESSION['customerPassword'] = $customerPassword ;
                $_SESSION['customerPasswordAgain'] = $customerPasswordAgain;
                $_SESSION['customerName'] = $customerName;
                $_SESSION['customerBirthdate'] = $customerBirthdate;
                $_SESSION['customerPhone'] = $customerPhone;
                $_SESSION['customerEmail'] = $customerEmail;
                $_SESSION['customerAddress'] = $customerAddress;
                $_SESSION['customerSex'] = $customerSex;

                $error = array();
                if(strlen($customerAccountName) == ""){
                    $error['customerAccountName'] = "Enter account name, please!";
                }
                if(strlen($customerPassword) == ""){
                    $error['customerPassword'] = "Enter the password, please!";
                }
                if(strlen($customerPasswordAgain) == ""){
                    $error['customerPasswordAgain'] = "Retype the password, please!";
                }
                if(trim($customerPassword) != trim($customerPasswordAgain)){
                    $error['PasswordOk'] = "The password must be the same, please!";
                }
                if(strlen($customerName) == ""){
                    $error['customerName'] = "Enter your name, please!";
                }
                if(strlen($customerAddress) == ""){
                    $error['customerAddress'] = "Enter the address, please!";
                }
                if(strlen($customerEmail) == ""){
                    $error['customerEmail'] = "Enter your email, please!";
                }
                if($customerSex == "0"){
                    $error['customerSex'] = "Please select a sex, please!";
                }
                if(empty($error)){
                    $password = md5($customerPassword);
                    $result = $this->customerModel->setCustomer($customerAccountName, $password, $customerName, $customerSex, $customerAddress, $customerPhone, $customerEmail, $customerBirthdate, $customerAuthorization);
                    if($result == "true"){
                        $error['thanhcong'] = "Please sign in to continue shopping!";

                        unset($_SESSION["customerAccountName"]);
                        unset($_SESSION['customerPassword']);
                        unset($_SESSION['customerPasswordAgain']);
                        unset($_SESSION['customerName']);
                        unset($_SESSION['customerBirthdate']);
                        unset($_SESSION['customerPhone']);
                        unset($_SESSION['customerEmail']);
                        unset($_SESSION['customerAddress']);
                        unset($_SESSION['customerSex']);

                        $this->getView("master3",[
                            "url"=>$this->getBaseUrl(),
                            "Page"=>"SignIn",
                            "ListProducer" => $this->producerModel->getList(),
                            "Error" => $error
                        ]);
                    }else{
                        $error['fail'] = "Registration failed, please try again!";
                        $this->getView("master4",[
                            "url"=>$this->getBaseUrl(),
                            "Page"=>"SignUp",
                            "ListProducer" => $this->producerModel->getList(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master4",[
                        "url"=>$this->getBaseUrl(),
                        "Page"=>"SignUp",
                        "ListProducer" => $this->producerModel->getList(),
                        "Error" => $error
                    ]);

                }

               
            }
        }
        //AddDangNhap
        function signInRole(){
            if(isset($_POST['btnSignIn'])){
                $customerAccountName = $_POST['txtAccountName'];
                $customerPassword = $_POST['txtPassword'];

                $error = array();
                if(strlen($customerAccountName) == ""){
                    $error['customerAccountName'] = "Enter account name, please!";
                }
                if(strlen($customerPassword) == ""){
                    $error['customerPassword'] = "Enter the password, please!";
                }

                if(empty($error)){
                    $matkhau = md5($customerPassword);
                    $result = $this->customerModel->customerSignInM($customerAccountName, $matkhau);
                    if($result == "true"){
                        $row = $this->customerModel->getCustomer($customerAccountName, $matkhau);
                        if($row['customer_authorization'] == 0){
                            $_SESSION['admin'] = $row;
                            $_SESSION["name"] = $row["customer_name"];

                            $this->Default();


                        }else if($row['customer_authorization'] == 1){
                            $_SESSION['customer'] = $row;
                            $_SESSION["name"] = $row["customer_name"];

                            $this->Default();
                        }
                    }else{
                        $error['notExist'] = "The account or password is incorrect, please try again!" ;
                        $this->getView("master3",[
                            "url"=>$this->getBaseUrl(),
                            "Page"=>"SignIn",
                            "ListProducer" => $this->producerModel->getList(),
                            "Error" => $error
                        ]);    
                    }
                }else{
                    $this->getView("master3",[
                        "url"=>$this->getBaseUrl(),
                        "Page"=>"SignIn",
                        "ListProducer" => $this->producerModel->getList(),
                        "Error" => $error
                    ]);
                }
            }
        }

        function signOut(){
            unset($_SESSION["name"]);
            unset($_SESSION["admin"]);
            unset($_SESSION["customer"]);
            unset($_SESSION['cart']);
            session_destroy();

            $this->Default();
       }

        function PersonalPage(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
                $customerAccountName = "";
                if(isset($_SESSION['admin'])){
                    $customerAccountName = $_SESSION['admin']['customer_account_name'];
                }
                if(isset($_SESSION['customer'])){
                    $customerAccountName = $_SESSION['customer']['customer_account_name'];
                }
                $this->getView("master3",[
                    "Page"=>"PersonalView",
                    "ListProducer" => $this->producerModel->getList(),
                    "OrderList" => $this->orderModel->getOrderList($customerAccountName),
                    "url"=>$this->getBaseUrl()
                ]);
            }else{
                $this->Default();
            }
       }

       //ThongTinCanNhan
       function PersonalInfo()
       {
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
                $this->getView("master3",[
                    "Page"=>"PersonalInfomation",
                    "ListProducer" => $this->producerModel->getList(),
                    "url"=>$this->getBaseUrl()
                ]);
            }else{
                $this->Default();
            }
       }

       //capNhatThongtinCaNhan
        function PersonalInfoUpdate(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            if(isset($_POST['btnInfoUpdate'])){
                $customerName = $_POST['txtCustomerName']; 
                $customerBirthdate = $_POST['txtCustomerBirthdate'];
                $customerAddress = $_POST['txtCustomerAddress'];
                $customerPhone = $_POST['txtCustomerPhone'];
                $customerEmail = $_POST['txtCustomerEmail'];
                $customerAccountName = "";
                if(isset($_SESSION['admin'])){
                    $customerAccountName = $_SESSION['admin']['customer_account_name'];
                }else{
                    $customerAccountName = $_SESSION['customer']['customer_account_name'];
                }
                
                $error = array();
                if(strlen(trim($customerName)) == ""){
                    $error['customerName'] = "Your name must not be empty!";
                }
                if(strlen(trim($customerAddress)) == ""){
                    $error['customerAddress'] = "Address cannot be empty!";
                }
                if(strlen(trim($customerEmail)) == ""){
                    $error['customerEmail'] = "Email cannot be empty!";
                }

                if(empty($error)){
                    $result = $this->customerModel->PersonalInfoUpdateM($customerAccountName, $customerName, $customerAddress , $customerPhone, $customerEmail, $customerBirthdate);
                    if($result == "true"){
                        $notice = "Information updated successfully!";

                        if(isset($_SESSION['admin'])){
                            $role = "admin";
                        }else{
                            $role = "customer";
                        }

                        $customerAccountName = "";
                        if(isset($_SESSION['admin'])){
                            $customerAccountName = $_SESSION['admin']['customer_account_name'];
                        }else{
                            $customerAccountName = $_SESSION['customer']['customer_account_name'];
                            }

                        $this->getView("master3",[
                            "Page"=>"PersonalView",
                            "ListProducer" => $this->producerModel->getList(),
                            "OrderList" => $this->orderModel->getOrderList($customerAccountName),
                            "url"=>$this->getBaseUrl(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master3",[
                            "Page"=>"PersonalInfomation",
                            "ListProducer" => $this->producerModel->getList(),
                            "url"=>$this->getBaseUrl(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master3",[
                        "Page"=>"PersonalInfomation",
                        "ListProducer" => $this->producerModel->getList(),
                        "url"=>$this->getBaseUrl(),
                        "Error" => $error
                    ]);
                }
                
            }
            }else{
                $this->Default();
            }
        }

        //DoiMatKhau
        function PasswordChange(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            if(isset($_POST['btnPasswordUpdate'])){
                $password = $_POST['txtPassword'];
                $passwordNew = $_POST['txtPasswordNew'];
                $passwordNewAgain = $_POST['txtPasswordNewAgain'];

                $customerAccountName = "";
                if(isset($_SESSION['admin'])){
                    $customerAccountName = $_SESSION['admin']['customer_account_name'];
                }else{
                    $customerAccountName = $_SESSION['customer']['customer_account_name'];
                }

                $error = array();
                if(strlen(trim($password)) == ""){
                    $error['password'] = "Current password cannot be empty!";
                }else{
                    $password = md5($password);
                    if($this->customerModel->checkPassword($password, $customerAccountName) == "false"){
                        $error['checkmatkhau'] = "The current password is incorrect!";
                    }else{
                        if(strlen(trim($passwordNew)) == ""){
                            $error['passwordNew'] = "w password cannot be empty!";
                        }
                        if(strlen(trim($passwordNewAgain)) == ""){
                            $error['passwordNewAgain'] = "Retype new password must not be empty!";
                        }
                        if(strlen(trim($passwordNew)) < 8 || strlen(trim($passwordNew)) > 256){
                            $error['password'] = "Password must be at least 8 characters and maximum of 255 characters!";
                        }
                        if(strlen(trim($passwordNew)) != strlen(trim($passwordNewAgain))){
                            $error['passwordOk'] = "Password must be the same!";
                        }
                    }
                }
                if(empty($error)){
                    $passwordNew = md5($passwordNew);
                    $result = $this->customerModel->PasswordChange($customerAccountName, $passwordNew);
                    if($result == "true"){
                        $notice = "Change password successfully!";

                        $role = "";
                        if(isset($_SESSION['admin'])){
                            $role = "admin";
                        }else{
                            $role = "customer";
                        }
                            $_SESSION[$role]['customer_password'] = $passwordNew;
                            
                            $this->getView("master3",[
                                "Page"=>"PersonalView",
                                "ListProducer" => $this->producerModel->getList(),
                                "OrderList" => $this->orderModel->getOrderList($customerAccountName),
                                "url"=>$this->getBaseUrl(),
                                "Notice" => $notice
                            ]);
                    }else{
                        $error['fail'] = "Password change failed";

                        $this->getView("master3",[
                            "Page"=>"PersonalInfomation",
                            "ListProducer" => $this->producerModel->getList(),
                            "url"=>$this->getBaseUrl(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master3",[
                        "Page"=>"PersonalInfomation",
                        "ListProducer" => $this->producerModel->getList(),
                        "url"=>$this->getBaseUrl(),
                        "Error" => $error
                    ]);
                }
            }
            }else{
                $this->Default();
            }
        }

       function Search(){
                
            if(!empty($_POST['q'])){
                $q = $_POST['q'];
                $result = $this->productModel->SearchSanPham($q);   
                
                while($output = mysqli_fetch_assoc($result)){
                    echo '<a href="'.$this->getBaseUrl().'Home/ProductSingle/'.$output['product_id'].'" class="list-group-item list-group-item-action border-1"  ><img src='.$this->getBaseUrl().'/public/uploads/'.$output['product_picture_name'].' with="50" height="50"/>'.$output['product_name'].'</a>';
                }
            }
       }

       //ViewSanPhamTheoNhaSanXuat
        function ProductOfProducer($producer_id){
            $this->getView("master5",[
                "Page"=>"ProductOfProducerView",
                "url"=>$this->getBaseUrl(),
                "ListProductOfProducer" => $this->productModel->getProductPromotionOfProducer($producer_id),
                "ListDescriptionProducer" => $this->producerModel->getIdDetail($producer_id),
                "ProducerName" => $this->producerModel->getIdDetail($producer_id)
            ]);
        }
        //ViewSanPhamDon
        function ProductSingle($product_id){
            $this->getView("master3",[
                "Page"=>"ProductSingleView",
                "ListProducer" => $this->producerModel->getList(),
                "url"=>$this->getBaseUrl(),
                "ProducerSingle" => $this->productModel->getProductSingle($product_id),
                "ProductSingle" => $this->productModel->getProductSingle($product_id),
                "PictureList" => $this->productModel->getProductPictureOfId($product_id),
                "PictureSingle" => $this->productModel->getProductPictureOfIdRepresent($product_id)
            ]);
        }
        function Cart(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            $this->getView("master3",[
                "Page"=>"ListCartView",
                "ListProducer" => $this->producerModel->getList(),
                "ListPayment" => $this->paymentModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
            }else{
                $error['cartFail'] = "Please login to continue shopping!";

                $this->getView("master4",[
                    "url"=>$this->getBaseUrl(),
                    "Page"=>"SignIn",
                    "ListProducer" => $this->producerModel->getList(),
                    "Error" => $error
                ]);
            }
        }

        function AddCart($ma){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            $product_id = isset($ma) ? (int)$ma : '';
            $product = $this->productModel->checkValidate($product_id);
            if($product){
                if(isset($_SESSION['cart'])){
                    //da ton tai//
    
                    if(isset($_SESSION['cart'][$product_id])){
                        $_SESSION['cart'][$product_id]['qty'] += 1;
                
                    }else{
                        $_SESSION['cart'][$product_id]['qty'] = 1;
                        $_SESSION['cart'][$product_id]['name'] = $product['product_name'];
                        $_SESSION['cart'][$product_id]['hinh'] = $product['product_picture_name'];
                        $_SESSION['cart'][$product_id]['gia'] = $product['product_price'];
                        
                    }
                   // $_SESSION['success'] = "Tồn tại giỏ hàng! Cập nhật mới thành công";
                    header("Location: /nguyentranmobile/Home/cart");
                }else{
    
                    $_SESSION['cart'][$product_id]['qty'] = 1;
                    $_SESSION['cart'][$product_id]['name'] = $product['product_name'];
                    $_SESSION['cart'][$product_id]['hinh'] = $product['product_picture_name'];
                    $_SESSION['cart'][$product_id]['gia'] = $product['product_price'];
                    //$_SESSION['success'] = "Tạo mới giỏ hàng thành công";
                    header("Location: /nguyentranmobile/Home/Cart");
                   
                }
            }else{
                //$_SESSION['success'] = "Không tồn tại sản phẩm trong cơ sở dữ liệu";
                header("Location: /nguyentranmobile/Home/Cart");
            }

            }else{
                $error['cartFail'] = "Please login to continue shopping!";

                $this->getView("master4",[
                    "url"=>$this->getBaseUrl(),
                    "Page"=>"SignIn",
                    "ListProducer" => $this->producerModel->getList(),
                    "Error" => $error
                ]);
            }
            
        }

        function UpdateCart(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            if(isset($_POST['id']) && isset($_POST['qty'])){
                $id = $_POST['id'];
                if(isset($_SESSION['cart'])){
                    $cart = $_SESSION['cart'];
                    if(array_key_exists($id, $cart)){
                        if($_POST['qty']){
                            $cart[$id] = array(
                                'name' => $cart[$id]['name'],
                                'hinh' => $cart[$id]['hinh'],
                                'gia' => $cart[$id]['gia'],
                                'qty' => $_POST['qty']
                            );
                        }else{
                            unset($cart[$id]);
                        }

                        $_SESSION['cart'] = $cart;
                    }
                }
            }
            }else{
                $this->Default();
            }
        }

        function DeleteCart($key){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
                if(isset($_SESSION['cart']) ){
                    header("Location: /nguyentranmobile/Home/Default");
                }

                $product_id = isset($key) ? (int)$key : '';
                if($product_id){
                    if(array_key_exists($product_id,$_SESSION['cart'])){
                        unset($_SESSION['cart'][$product_id]);
                        $_SESSION['success'] = "Delete the cart successfully";
                    }
                }
                header("Location: /nguyentranmobile/Home/Cart");
            }else{
                $this->Default();
            }
        }


        function PaymentProduct()
        {
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            if(isset($_POST["btnThanhToan"])){

                // Kiểm tra hình thức thanh toán
                if(!isset($_POST["rdHTTT"])){
                    $this->getView("master3",[
                        "Page"=>"ListCartView",
                        "ListProducer" => $this->producerModel->getList(),
                        "ListPayment" => $this->paymentModel->getList(),
                        "url"=>$this->getBaseUrl(),
                        "Error" => "Please select a form of payment!"
                    ]);
                    return false;
                }
                $address = "";
                $accountName = "";
                if(isset($_SESSION['admin'])){
                    $address = $_SESSION['admin']['customer_address'];
                    $accountName = $_SESSION['admin']['customer_account_name'];
                }
                if(isset($_SESSION['customer'])){
                    $address = $_SESSION['customer']['customer_address'];
                    $accountName = $_SESSION['customer']['customer_account_name'];
                }
                // Tạo đơn hàng
                $orderId = $this->orderModel->GetIDOrder() + 1;
                $orderDate = gmdate('Y-m-d H:i:s');
                $orderAddress =  $address;
                $orderStatus = 0;
                $paymentId = $_POST["rdHTTT"];
                $customerAccountName = $accountName;

                $result1 = $this->orderModel->CreateOrder($orderId, $orderDate, $orderAddress, $orderStatus, $paymentId, $customerAccountName);
                $result2 = "";
                $result3 = "";

                if(isset($_SESSION["cart"])){
                    foreach ($_SESSION["cart"] as $key => $val) {
                        $productId = $key;
                        $productAmount = $val["qty"]; 
                        $productPrice = $val["gia"];
                        $result2 = $this->orderModel->AddProductToBill($productId, $orderId, $productAmount, $productPrice); 
                        $result3 = $this->orderModel->UpdateAmount($productId, $orderId); 
                    }
                }
                
                if($result1 == "true" && $result2 == "true" && $result3 == "true"){
                    $notice = "Order Success. Products will be shipped to you as soon as possible!";
                    unset($_SESSION['cart']);
                }else{
                    $notice = "Order failed. Please check again!";
                }
                $this->getView("master3",[
                    "Page"=>"ListCartView",
                    "ListProducer" => $this->producerModel->getList(),
                    "ListPayment" => $this->paymentModel->getList(),
                    "url"=>$this->getBaseUrl(),
                    "Notice" => $notice
                ]);
                

            }else{
                $this->getView("master3",[
                    "Page"=>"ListCartView",
                    "ListProducer" => $this->producerModel->getList(),
                    "ListPayment" => $this->paymentModel->getList(),
                    "url"=>$this->getBaseUrl(),
                ]);
            }
        }else{
            $error['loithanhtoan'] = "Please login to continue shopping!";

            $this->getView("master4",[
                "url"=>$this->getBaseUrl(),
                "Page"=>"SignIn",
                "ListProducer" => $this->producerModel->getList(),
                "Error" => $error
            ]);
        }
        }

        function CheckUsername($tendangnhap)
        {
            if(trim(strlen($tendangnhap))< 6 || trim(strlen($tendangnhap))> 50 ){
                echo "<p style='color:red'>Username from 6 to 50 characters!</p>";
                return;
            }
            if(!$this->customerModel->CheckUsername($tendangnhap)){
                echo "<p style='color:red'>Accountname available!</p>";
            }else{
                echo "<p style='color:green'>Your accountname is valid!</p>";
            }
        }

        
        function CheckEmail($email)
        {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p style='color:red'>Invalid email.</p>";
                return;
            }
            if(!$this->customerModel->CheckEmail($email)){
                echo "<p style='color:red'>The Email was registered. Please use another email!</p>";
            }else{
                echo "<p style='color:green'>Email valid!</p>";
            }
        }

        function ViewFeedback(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            $this->getView("master3", [
                "url"=>$this->getBaseUrl(),
                "Page" => "FeedbackOfCustomers",
                "ListCDGY" => $this->feedback_topicModel->getList(),
                "ListProducer" => $this->producerModel->getList()
            ]);
            }else{
                $error['loigopy'] = "Please login to continue to feedback!";

                $this->getView("master4",[
                    "url"=>$this->getBaseUrl(),
                    "Page"=>"SignIn",
                    "ListProducer" => $this->producerModel->getList(),
                    "Error" => $error
                ]);
            }
        }

        function FeedbackCustomers(){
            if(isset($_SESSION['admin']) || isset($_SESSION['customer'])){
            if(isset($_POST["btnFeedback"])){}
                $feedbackTopicId = $_POST["slFeedbackTopic"];
                $feedbackContent = $_POST["txtFeedbackContent"];

                $quantri = "";
                if(isset($_SESSION['admin'])){  
                    $quantri = "admin";
                }
                if(isset($_SESSION['customer'])){
                    $quantri = "customer";
                }
                $feedbackName = $_SESSION[$quantri]['customer_name'];
                $feedbackEmail = $_SESSION[$quantri]['customer_email'];
                $feedbackAddress = $_SESSION[$quantri]['customer_address'];
                $feedbackPhone = $_SESSION[$quantri]['customer_phone'];
                $feedbackDate = gmdate('Y-m-d');

                $error = array();
                if($feedbackTopicId == "0"){
                    $error['feedbackTopicId'] = "You need to choose a feedback topic!"; 
                }
                if(strlen($feedbackContent) == ""){
                    $error['feedbackContent'] = "You need to enter feedbacks!";
                }
                if(empty($error)){
                    $result = $this->feedbackModel->setFeedback($feedbackName, $feedbackEmail, $feedbackAddress, $feedbackPhone, $feedbackContent, $feedbackDate, $feedbackTopicId);
                    if($result == "true"){
                        $notice = "Successfully submitted";

                        $this->getView("master3", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "FeedbackOfCustomers",
                            "ListCDGY" => $this->feedback_topicModel->getList(),
                            "ListProducer" => $this->producerModel->getList(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Feedback failed";
                        $this->getView("master3", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "FeedbackOfCustomers",
                            "ListCDGY" => $this->feedback_topicModel->getList(),
                            "ListProducer" => $this->producerModel->getList(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master3", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "FeedbackOfCustomers",
                        "ListCDGY" => $this->feedback_topicModel->getList(),
                        "ListProducer" => $this->producerModel->getList(),
                        "Error" => $error
                    ]);
                }
            }else{
                $this->Default();
            }
        }
            
    }
?>