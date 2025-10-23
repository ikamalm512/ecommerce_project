<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/profile-custom.css'])

    <title>ShopEase - Products</title>
    <style>
      
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
           
            display: flex;
            flex-direction: column;
        }

    .navbar {
            min-height: 80px;
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            justify-content: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            width: 90%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: #2c3e50;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            text-decoration: none;
            color: #495057;
            font-size: 16px;
            font-weight: 500;
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0%;
            height: 2px;
            background-color: #0d6efd;
            transition: width 0.3s ease;
        }

        .nav-links a:hover {
            color: #0d6efd;
        }

        .nav-links a:hover::after {
            width: 100%;
        }


.nav-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.cart {
    font-size: 20px;
    text-decoration: none;
    color: #0d6efd;
    transition: transform 0.3s ease;
  
    opacity: 0;
    transform: translateY(20px);
    animation: talkAppear 0.8s ease-out forwards;
    animation-delay: 1.0s; 
}

.cart:hover {
    transform: scale(1.2);
}

.auth-buttons {
    display: flex;
    gap: 10px;
}

.talk-btn {
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    
    background-color: #0d6efd;
    color: white;
    border: none;
    padding: 8px 18px;
    border-radius: 30px;
    font-size: 15px;
    font-weight: 500;
    box-shadow: 0 4px 8px rgba(13, 110, 253, 0.25);
    cursor: pointer;
    
   
    opacity: 0;
    transform: translateY(20px);
    animation: talkAppear 0.8s ease-out forwards;
    
    transition: all 0.3s ease;
}

.talk-btn:hover {
    background-color: #0b5ed7;
    transform: translateY(-2px);
}


.nav-right .auth-buttons .profile-btn,
.nav-right .auth-buttons .login-btn {
    animation-delay: 1.2s; 
}

.nav-right .auth-buttons .logout-btn {
    background-color: #dc3545;
    box-shadow: 0 4px 8px rgba(220, 53, 69, 0.25);
    animation-delay: 1.4s; 
}

.nav-right .auth-buttons .logout-btn:hover {
    background-color: #c82333;
}


@keyframes talkAppear {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
     
        main {
          
            flex-grow: 1;
          
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 0;
            box-sizing: border-box;
        }

       
        .product-section {
            width: 90%;
            max-width: 1300px;
            margin-top: 30px;
          
        }

      
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
          
            gap: 30px;
        }

    
        .product-card {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            transition: all 0.4s ease;
            animation: fadeUp 0.8s ease forwards;
            transform: translateY(40px);
            opacity: 0;
        }

        @keyframes fadeUp {
            0% {
                transform: translateY(40px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

     
        .product-image {
            background-color: #eaecef;
            height: 250px;
            position: relative;
            border-bottom: 1px solid #ddd;
            display: flex;
           
            align-items: center;
           
            justify-content: center;
           
            font-size: 3rem;
            
            color: #b0bec5;
          
        }

        .product-image i {
            opacity: 0.6;
        }

        
        .product-badge {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: #0d6efd;
           
            color: #fff;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 600;
        }

       
        .product-badge.new {
            background-color: #28a745;
          
        }

        .product-badge.hot {
            background-color: #dc3545;
           
        }

        .product-badge.sale {
            background-color: #ffc107;
           
            color: #333;
           
        }

        .product-badge.top,
        .product-badge.best {
            background-color: #6f42c1;
        }

      
        .add-to-cart {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translate(-50%, 30px);
            background-color: #0d6efd;
            color: #fff;
            padding: 10px 25px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            opacity: 0;
            transition: all 0.4s ease;
        }

        
        .product-card:hover .add-to-cart {
            opacity: 1;
            transform: translate(-50%, 0);
            animation: cartFadeIn 0.5s ease forwards;
        }

        @keyframes cartFadeIn {
            0% {
                opacity: 0;
                transform: translate(-50%, 30px);
            }

            100% {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }

       
        .product-info {
            padding: 20px;
            text-align: center;
        }

        .product-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }

        .product-rating {
            color: #ffcc00;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 1rem;
            font-weight: 600;
            color: #0d6efd;
        }

       
        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

    
        .product-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .product-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .product-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .product-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .product-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .product-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        .product-card:nth-child(7) {
            animation-delay: 0.7s;
        }

        .product-card:nth-child(8) {
            animation-delay: 0.8s;
        }

        .product-card:nth-child(9) {
            animation-delay: 0.9s;
        }

        .product-card:nth-child(10) {
            animation-delay: 1.0s;
        }

        .product-card:nth-child(11) {
            animation-delay: 1.1s;
        }

        .product-card:nth-child(12) {
            animation-delay: 1.2s;
        }

        .product-card:nth-child(13) {
            animation-delay: 1.3s;
        }

        .product-card:nth-child(14) {
            animation-delay: 1.4s;
        }

        .product-card:nth-child(15) {
            animation-delay: 1.5s;
        }

        .product-card:nth-child(16) {
            animation-delay: 1.6s;
        }

        .product-card:nth-child(17) {
            animation-delay: 1.7s;
        }

        .product-card:nth-child(18) {
            animation-delay: 1.8s;
        }

        .product-card:nth-child(19) {
            animation-delay: 1.9s;
        }

        .product-card:nth-child(20) {
            animation-delay: 2.0s;
        }

        .product-card:nth-child(21) {
            animation-delay: 2.1s;
        }

        .product-card:nth-child(22) {
            animation-delay: 2.2s;
        }

        .product-card:nth-child(23) {
            animation-delay: 2.3s;
        }

        .product-card:nth-child(24) {
            animation-delay: 2.4s;
        }

        .product-card:nth-child(25) {
            animation-delay: 2.5s;
        }

        .product-card:nth-child(26) {
            animation-delay: 2.6s;
        }

        .product-card:nth-child(27) {
            animation-delay: 2.7s;
        }

        .product-card:nth-child(28) {
            animation-delay: 2.8s;
        }

        .product-card:nth-child(29) {
            animation-delay: 2.9s;
        }

        .product-card:nth-child(30) {
            animation-delay: 3.0s;
        }


     
        @media (max-width: 992px) {
            .product-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }
        }


        .footer {
            background-color: #f1f3f5;
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            border-top: 1px solid #dee2e6;
            padding: 30px 0;
           
        }

        .footer-container {
            width: 90%;
            max-width: 1200px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
        }


        .footer-left {
            width: 60%;
        }

        .footer-logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 10px;
        }

        .footer-about {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
        }


        .footer-right {
            width: 30%;
            text-align: right;
        }

        .footer-title {
            font-size: 1.2rem;
            margin-bottom: 12px;
            color: #0d6efd;
        }

        .footer-social a {
            color: #495057;
            font-size: 1.2rem;
            margin-left: 12px;
            transition: all 0.3s ease;
        }

        .footer-social a:hover {
            color: #0d6efd;
            transform: scale(1.25);
        }
    </style>
</head>

<body>

@include('layouts.header')



   {{ $slot }}

@include('layouts.footer')

   


</body>

</html>