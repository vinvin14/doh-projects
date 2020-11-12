<style>
    body
    {
        background-color: #f5f5f5;

    }
    .bg
    {
        background-image: url("/includes/images/back3.jpg");
        background-size: cover;
    }
    *
    {
        box-sizing: border-box;
    }
    .wrapper
    {
        display: flex;
        width: 100%;
        align-content: stretch;
    }
    .sidebar-content
    {
        padding-top: 10px;
        min-width: 250px;
        max-width: 250px;
        background-image: linear-gradient(to top, #283c86, #45a247);
        z-index: 999;
    }
    .sidebar-items
    {
        margin-top: 5px;
    }
    .sidebar-title
    {
        font-size: 14px;
        /*border-top: 1px solid white;*/
        /*border-bottom: 1px solid white;*/
        color: white;
        margin-bottom: 5px;
        /*padding:10px;*/
        /*margin: 0px 10px;*/
        cursor: pointer;
    }
    .sidebar-title:hover
    {
        color: black;
        transition: all 1s;
    }
    .sidebar-items a
    {
        display: block !important;
        padding-left: 25px;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-bottom: 6px;
        text-decoration: none !important;
        color: white;
        font-size: 13px;
        letter-spacing: 2px;
    }
    .sidebar-items .active
    {
        background-color:rgba(255, 255, 255, 0.5);
        color: black;
    }
    .sidebar-items a:hover
    {
        background-color:rgba(255, 255, 255, 0.5);
        color: black;
        transition: 1s;
    }
    #sidebar-icon
    {
        margin-right: 15px;
        margin-left: 10px;
    }
    .navbar-content
    {
        background-color: white;
        overflow: hidden;
    }
    .navbar-content li
    {
        display: inline-block;
        padding-left: 15px;
        color: gray;
        font-weight: bold;
        font-size: 13px;
    }
    .navbar-content li:hover
    {
        color: black;
        cursor: pointer;
        transition: all 1s;
    }
    .main-content
    {
        width: 100%;
        min-height: 100vh;
    }
    .main-page
    {
        padding-top: 25px;
        padding-left: 10px;
    }
    #search
    {
        border: none;
        border-bottom: 1px solid #D6D6D6;
        border-radius: 0;
        box-shadow: none !important;
        background-color: transparent;
    }
    #search:focus
    {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none !important;
    }
    button:focus
    {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none !important;
    }
</style>
<div class="wrapper">
    <nav class="sidebar-content shadow">
        <?=@$sidebar?>
    </nav>
    <main class="main-content">
        <div class="navbar-content">
            <?=@$navbar?>
        </div>
        <div class="main-page">
            <div class="bg"></div>
            <?=@$main?>
        </div>
    </main>
</div>
