<?php
$jsonString = file_get_contents("./data/kea-dhcp4.conf");
$decodedJson = json_decode($jsonString, true);

$interface = $decodedJson['Dhcp4']['interfaces-config']['interfaces'][0];
$validLifetime = $decodedJson['Dhcp4']['valid-lifetime'];

function cidreToSubnetMask(int $cidre): string
{
    $numOfFullOctets = floor($cidre / 8);
    $numOfBitsInPartialOctet = $cidre % 8;
    $numOfZeroBits = 32 - $cidre;

    $subnetMaskBinary = str_repeat("11111111", $numOfFullOctets);

    $subnetMaskBinary .= str_repeat("1", $numOfBitsInPartialOctet);

    $subnetMaskBinary .= str_repeat("0", $numOfZeroBits);

    $subnetMaskBinaryDotNotation = "";
    for ($i = 0; $i < strlen($subnetMaskBinary); $i++) {
        $subnetMaskBinaryDotNotation .= $subnetMaskBinary[$i];
        if (($i + 1) % 8 == 0 && $i != strlen($subnetMaskBinary) - 1) {
            $subnetMaskBinaryDotNotation .= ".";
        }
    }

    $octetsBinary = explode(".", $subnetMaskBinaryDotNotation);

    $subnetMaskDecimal = "";

    foreach ($octetsBinary as $octetBinary) {
        $subnetMaskDecimal .= bindec($octetBinary) . ".";
    }

    return trim($subnetMaskDecimal, ".");
}

$cidre = (int)explode("/", $decodedJson['Dhcp4']['subnet4'][0]['subnet'])[1];
$ipAddress = "10.101.105.170";
$subnetMask = cidreToSubnetMask($cidre);

$decodedJson['Dhcp4']['subnet4'][0]['option-data'][0]['data'] = "10.101.105.0";
$gateway = $decodedJson['Dhcp4']['subnet4'][0]['option-data'][0]['data'];

$decodedJson['Dhcp4']['subnet4'][0]['option-data'][1]['data'] = "1.1.1.1";
$decodedJson['Dhcp4']['subnet4'][0]['option-data'][2]['data'] = "patrick-bbq.zz";

$dnsServer = $decodedJson['Dhcp4']['subnet4'][0]['option-data'][1]['data'];
$dnsName = $decodedJson['Dhcp4']['subnet4'][0]['option-data'][2]['data'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>kea-dhcp.conf-reader</title>
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <div class="logo">
            <img src="../../portfolio-website/assets/icons/main-icon.svg" alt="main icon" width="48px" height="48px">
        </div>
        <ul class="menu">
            <li class="nav-item">
                <a href="../../portfolio-website">Home</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
            <li class="nav-item">
                <a href="#">placeholder</a>
            </li>
        </ul>
        <div class="profile-picture">
            <img src="../../portfolio-website/assets/icons/profile-pic-icon.svg" alt="profile picture" width="48px"
                 height="48px">
        </div>
    </nav>
    <main>
        <h1>kea-dhcp.conf reader</h1>
        <p>Lists certain values read from kea-dhcp.conf using JSON decoding in PHP.</p>
        <div class="conf-values-container">
            <div class="conf-values-list">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="GET">
                    <ul>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">Interface: </span><?= $interface ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more" name="btn-interface">></button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">Valid Lifetime: </span><?= $validLifetime ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more" name="btn-lifetime">
                                >
                            </button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">IP-Address: </span><?= $ipAddress ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more"
                                    name="btn-ip-address">>
                            </button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">Subnet Mask: </span><?= $subnetMask ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more"
                                    name="btn-subnet-mask">>
                            </button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">Gateway: </span><?= $gateway ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more" name="btn-gateway">
                                >
                            </button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">DNS-Server: </span><?= $dnsServer ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more"
                                    name="btn-dns-server">>
                            </button>
                        </li>
                        <li class="conf-values-list-item">
                            <div class="value-display">
                                <span class="value-name">DNS Name: </span><?= $dnsName ?>
                            </div>
                            <button type="submit" class="conf-values-list-arrow" title="Show more" name="btn-dns-name">
                                >
                            </button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </main>
</div>
</body>
</html>
