<nav>
    <h4><?php echo $index->getNameById($_SESSION["user"]["id"]);?></h4>
    <div>
        <p class="drop_click" id="drop_">drop down <i class="fas fa-caret-down"></i></p>
        <ul class="drop-dowsn-items">
            <li><a href="index.php?signout=true">sign out</a></li>
            <li>log in</li>
            <li>our policy</li>
            <li>cookie policy</li>
            <li>our products</li>
        </ul>
    </div>
</nav>

