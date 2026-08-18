<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Eterno Hotels & Resorts | Coming Soon</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

:root{
    --primary:#9B8158;
    --white:#ffffff;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family: "Libre Baskerville", serif;
    background:#000;
    color:#fff;
}

.coming-soon{
    min-height:100vh;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    padding:40px 20px;
    overflow:hidden;
}

/* Background Image */
.coming-soon::before{
    content:'';
    position:absolute;
    inset:0;
    background:url(cmg-soon-bg2.jpg) center center/cover no-repeat;
    filter:brightness(0.80);
}

.content{
    position:relative;
    z-index:2;
    max-width:850px;
}

/* Logo */
.logo{
    margin-bottom:40px;
}

.logo img{
    width:220px;
    max-width:80%;
    height:auto;
}

/* Tagline */
.small-title{
    color:var(--primary);
    text-transform:uppercase;
    letter-spacing:4px;
    font-size:14px;
    margin-bottom:15px;
}

h1{
    font-family: "Libre Baskerville", serif;
    font-size:clamp(2.5rem,7vw,4rem);
    font-weight:600;
    line-height:1.1;
    margin-bottom:20px;
}

.description{
    max-width:700px;
    margin:auto;
    font-size:18px;
    line-height:1.9;
    color:rgba(255,255,255,.85);
}

.resorts{
    margin:40px 0;
    display:flex;
    justify-content:center;
    gap:15px;
    flex-wrap:wrap;
}

.resorts span{
    border:1px solid rgba(255,255,255,.15);
    padding:12px 22px;
    border-radius:40px;
    background:rgba(255,255,255,.05);
    backdrop-filter:blur(10px);
}

.buttons{
    margin-top:40px;
    display:flex;
    justify-content:center;
    gap:20px;
    flex-wrap:wrap;
}

.btn{
    text-decoration:none;
    padding:15px 35px;
    border-radius:50px;
    transition:.4s;
    font-size:14px;
    letter-spacing:1px;
}

.btn-primary{
    background:var(--primary);
    color:#fff;
}

.btn-primary:hover{
    transform:translateY(-3px);
}

.btn-outline{
    border:1px solid var(--primary);
    color:#fff;
}

.btn-outline:hover{
    background:var(--primary);
}

.footer-text{
    margin-top:50px;
    color:rgba(255,255,255,.7);
    font-size:14px;
}

.contact-info{
      margin-top:50px;
    padding:25px;
    background:rgb(98 98 98 / 21%);
    border:1px solid rgba(255,255,255,.08);
    /* backdrop-filter:blur(10px); */
    border-radius:15px;
    max-width:700px;
    margin-left:auto;
    margin-right:auto;
    
}

.contact-info h4{
    color:var(--primary);
    margin-bottom:20px;
    font-size:20px;
    letter-spacing:1px;
}

.contact-info p{
    color:rgba(255,255,255,.8);
    line-height:1.8;
    font-size:15px;
    margin-bottom:8px;
}

.contact-info i{
    color:var(--primary);
    min-width:20px;
    font-size:18px;
    margin-top:5px;
}

.contact-info a{
    color:#fff;
    text-decoration:none;
    transition:.3s;
}

.contact-info a:hover{
    color:var(--primary);
}

@media(max-width:768px){
    .contact-info p{
        font-size:14px;
    }
}

@media(max-width:768px){

    .logo img{
        width:180px;
    }

    .description{
        font-size:16px;
    }

    .resorts{
        flex-direction:column;
        align-items:center;
    }

    .buttons{
        flex-direction:column;
        align-items:center;
    }

    .btn{
        width:250px;
    }
}

</style>
</head>
<body>

<section class="coming-soon">

    <div class="content">

        <div class="logo">
            <img src="logo.png" alt="Eterno Hotels & Resorts">
        </div>

        <div class="small-title">
            Eterno Hotels & Resorts
        </div>

        <h1>
            Our New Website Is Coming Soon
        </h1>

        <div class="resorts">
            <span>Camellia & Elettaria</span>
            <span>Capithans Dale</span>
            <span>Amber</span>
        </div>


        <div class="footer-text">
    Luxury • Nature • Experiences
</div>

<div class="contact-info">

    <h4>Contact Us</h4>

    <p>
        <i class="fa-solid fa-location-dot"></i>
        Kavumkal Dream Destination Pvt. Ltd.<br>
        2/288, Kavumkal Building,<br>
        Ranni P.O., Pathanamthitta,<br>
        Kerala, India - 689 672
    </p>

    <p>
        <i class="fa-solid fa-phone"></i>
        <a href="tel:+919744227000">
            +91 97 442 27 000
        </a>
    </p>

    <p>
        <i class="fa-solid fa-envelope"></i>
        <a href="mailto:sales@eternohotelsresorts.com">
            sales@eternohotelsresorts.com
        </a>
    </p>

</div>

    </div>

</section>

</body>
</html>