<div class="row">
  <div class="container">
    <h1>HOOP<span>BOOK</span><h1>
    <a class="blink" href="<?php echo base_url ?>user/?page=add" ?>Reserved Now!</a>
  </div>
  <style>
    .row{ 
        width: 100%;
        height: calc(100vh - 69px);
        align-items: center;
    }
    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    .blink {
        animation: blinker 1.5s linear infinite;
        color: red;
        font-size: 1.5em;
        /* Larger, responsive font size */
        margin-bottom: 20px;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }
    .container h1{
        font-size: 100px;
        color: #0D1847;
        font-family: sans-serif;
    }
    .container span{
        background: #0D1847;
        color: #F5AF43;
        padding: 10px 20px;
        font-family: sans-serif;
    }
    .container a{
        font-size: 50px;
        margin: 0;
        text-decoration: none;
        background: #F5AF43;
        height: 50px;
        width: 100px;
        padding: 5px 20px;
        border-radius: 5px;
    }
  </style>
</div>

