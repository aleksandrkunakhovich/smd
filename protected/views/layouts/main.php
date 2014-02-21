<?php
$users = [
    ['location'=>'Украина Симферополь','title'=>'Александр'],
    ['location'=>'Украина Киев','title'=>'Виктор'],
    ['location'=>'Украина Одесса','title'=>'Коля'],
    ['location'=>'Украина Ялта','title'=>'Костя'],
    ['location'=>'Россия','title'=>'Петя'],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Members Directory</title>
    <link rel="stylesheet" href="css/reset.css"/>
    <link rel="stylesheet" href="css/style.css"/>
    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2OG-xrf0I3mkBtxnajYDgWr4G3tUlUI4&sensor=true">
    </script>
    <script src="js/map.js"></script>
    <script> var usersRawData = '<?=json_encode($users)?>'; </script>
</head>
<body>
<div id="wrapper">

    <div id="header">
        <h1>Members Directory</h1>
    </div>

    <div id="map-container">
        <div id="map"></div>
    </div>

    <form>
        <div id="controls">
            <div id="control-left">

                <div class="control-row">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name"/>
                </div>

                <div class="control-row">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city"/>
                </div>

                <div class="control-row">
                    <label for="name">Country:</label>
                    <select name="country" id="country">
                        <option value="">1</option>
                    </select>
                </div>

                <div class="control-row">
                    <label for="credentials">Forum Credentials:</label>
                    <select name="credentials" id="credentials">
                        <option value="">1</option>
                    </select>
                </div>

            </div>
            <div id="control-right">

                <div class="control-row">
                    <label for="role">Role:</label>
                    <select name="role" id="role">
                        <option value="">1</option>
                    </select>
                </div>

                <div class="control-row">
                    <label for="areaExp">Area of Expertise:</label>
                    <select name="areaExp" id="areaExp">
                        <option value="">1</option>
                    </select>
                </div>

                <div class="control-row">
                    <label for="knowledge">Platform Knowledge:</label>
                    <input type="text" id="knowledge" name="knowledge"/>
                </div>

                <div class="control-row">
                    <label for="name">Available for Hire:</label>
                    <input type="checkbox"/> <span>Yes</span>
                </div>

            </div>

            <div class="clear"></div>

            <div id="control-buttons">
                <input type="submit" value="Search Members"/>
                <input type="reset" value="Clear"/>
            </div>

        </div>
    </form>

    <table cellspacing="30">
        <thead>
            <tr>
                <td>Name & Location</td>
                <td>Role & Credentials</td>
                <td>Expertise</td>
                <td>Platform Knowledge</td>
                <td>Available?</td>
                <td>Learn More & Contact</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <h3>AndrewYouderian</h3>
                    <p>eCommerceFuel.com Bozeman, United States</p>
                </td>
                <td>
                    <p>Store Owner (F/T) Level 3</p>
                </td>
                <td>
                    <h4>Marketing</h4>
                    <p>SEO</p>
                </td>
                <td>
                    <p>Magento</p>
                    <p>Zendesk</p>
                </td>
                <td style="width: ">
                    <p>Yes</p>
                </td>
                <td>
                    <a href="#">See Full Profile</a>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>AndrewYouderian</h3>
                    <p>eCommerceFuel.com Bozeman, United States</p>
                </td>
                <td>
                    <p>Store Owner (F/T) Level 3</p>
                </td>
                <td>
                    <h4>Marketing</h4>
                    <p>SEO</p>
                </td>
                <td>
                    <p>Magento</p>
                    <p>Zendesk</p>
                </td>
                <td style="width: ">
                    <p>Yes</p>
                </td>
                <td>
                    <a href="#">See Full Profile</a>
                </td>
            </tr>
            <tr>
                <td>
                    <h3>AndrewYouderian</h3>
                    <p>eCommerceFuel.com Bozeman, United States</p>
                </td>
                <td>
                    <p>Store Owner (F/T) Level 3</p>
                </td>
                <td>
                    <h4>Marketing</h4>
                    <p>SEO</p>
                </td>
                <td>
                    <p>Magento</p>
                    <p>Zendesk</p>
                </td>
                <td style="width: ">
                    <p>Yes</p>
                </td>
                <td>
                    <a href="#">See Full Profile</a>
                </td>
            </tr>
        </tbody>
    </table>

    <div id="footer">2 of 350 members meet criteria</div>
</div>
</body>
</html>