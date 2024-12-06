<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>

    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

</head>


<body>

<div class="container">

    <form action="">


        <div class="row">
            <div class="col">

                <h3 class="title">Billing Address</h3>

                <div class="inputBox">
                    <span>Full Name :</span>
                    <input type="text" placeholder="johnthan newton ">
                </div>

                <div class="inputBox">
                    <span>Email :</span>
                    <input type="email" placeholder="john@outlook.com">
                </div>

                <div class="inputBox">
                    <span>Address :</span>
                    <input type="text" placeholder=" location ">
                </div>

                <div class="inputBox">
                    <span>City :</span>
                    <input type="text" placeholder="Birmingham ">
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>Country :</span>
                        <input type="text" placeholder="United Kingdom ">
                    </div>
                    <div class="inputBox">
                        <label for="post-code">Post Code:</label>
                        <input type="text" id="post-code" name="post-code" placeholder="WG6 3ZT"
                               pattern="^([A-Za-z]{1,2}\\d[A-Za-z\\d]? \\d[A-Za-z]{2})$" required>
                    </div>
                </div>



            </div>
            <div class="col">

                <h3 class="title">Payment</h3>

                <div class="inputBox">
                    <span>Name on Card  :</span>
                    <input type="text" placeholder="johnthan newton  ">
                </div>

                <div class="inputBox">
                    <span>Credit Card Number :</span>
                    <input type="number" placeholder="1111-2222-3333-4444">
                </div>

                <div class="inputBox">
                    <span>Expiry Date (Month) :</span>
                    <input type="text" placeholder="MM" maxlength="2">
                </div>








                <div class="flex">
                    <div class="inputBox">
                        <span>Expiry Date  :</span>
                        <input type="text" placeholder="YYYY" maxlength="4">
                    </div>
                    <div class="inputBox">
                        <span>CVV :</span>
                        <input type="text" placeholder="123" maxlength="3">




                    </div>






                </div>



            </div>




        </div>


        <input type="submit" value="checkout">







    </form>

</div>


</body>








</html>
