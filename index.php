<?php echo file_get_contents("html/header.html"); ?>

<div class='parallax1'>
    <div class='welcome'>
        <div class='title bar'>
            <h2> SubShare </h2>
            <br>
            <p> Easily coordinate sharing subscriptions with your friends & family!</p>
	    </div>
        <button class="btn" href='home.php'>Get Started Now!</button>
    </div>
</div>
<div class="about col-1-4">
        <!-- split the div -->
    <div> <!-- left 20% -->
        <h3> About </h3>
    </div>
    <div> <!-- right 75% -->
        <p>Subshare is a project to help coordinate splitting bills for subscriptions! 
        Just select the subscription, price, and participants</p>
    </div>
</div>
<div class='parallax2'>
    <div class='demo col-1-1'>
        <div class='table-display'>
            <div>

            </div>
            <div>
		<table>
		    <tr>
                        <th></th>
                        <th>Hulu</th>
                        <th>Netflix</th>
                        <th>HBO Max</th>
                        <th>etc.</th>
                    </tr>
                    <tr>
                        <td>Me</td>
                        <td><span class="material-icons">check</span></td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td><i class="material-icons-outlined"></i></td>
                    </tr>
                    <tr>
                        <td>Dan</td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td></td>
                        <td><i class="material-icons-outlined"></i></td>
                    </tr>
                    <tr>
                        <td>Angela</td>
                        <td></td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Sean</td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td></td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Candice</td>
                        <td><i class="material-icons-outlined"></i></td>
                        <td></td>
                        <td></td>
                        <td><i class="material-icons-outlined"></i></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class='table-display'>

        </div>    
    </div>
</div>
<?php echo file_get_contents("html/footer.html"); ?>
