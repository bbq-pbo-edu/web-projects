<?php
$jsonString = file_get_contents("./data/kea-dhcp4.conf");
$decodedJson = json_decode($jsonString, true);

$interface = $decodedJson['Dhcp4']['interfaces-config']['interfaces'][0];
$validLifetime = $decodedJson['Dhcp4']['valid-lifetime'];

function cidreToSubnetMask(int $cidre): string
{
    // Only accept valid cidre (0 - 32)
    if ($cidre < 0 or $cidre > 32) {
        return "Invalid CIDRE( $cidre ). Must be between 0 and 32.";
    }
    // number of 1s = cidre ; number of 0s = 32 - cidre
    $numOfZeroBits = 32 - $cidre;
    $subnetMaskBinary = str_repeat("1", $cidre) . str_repeat("0", $numOfZeroBits);

    // Add a dot after every 8 bits except for final 8 bits
    $subnetMaskBinaryDotNotation = "";
    for ($i = 0; $i < strlen($subnetMaskBinary); $i++) {
        $subnetMaskBinaryDotNotation .= $subnetMaskBinary[$i];
        if (($i + 1) % 8 == 0 && $i != strlen($subnetMaskBinary) - 1) {
            $subnetMaskBinaryDotNotation .= ".";
        }
    }

    // Split binary string into 4 octets with 8 bits each
    $octetsBinary = explode(".", $subnetMaskBinaryDotNotation);

    // Convert each binary octet to decimal and add to final output
    $subnetMaskDecimal = "";
    foreach ($octetsBinary as $octetBinary) {
        $subnetMaskDecimal .= bindec($octetBinary) . ".";
    }

    // Remove any trailing dots, then return the output
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
    <aside class="info-card-container">
        <div class="info-card-content">
            <h2>Interface</h2>
            <div class="accent-separator"></div>
            <p class="info-text"></p>
            <div class="code-container">
                <div class="code-title-bar">
                    <h5>kea-conf-reader.php</h5>
                </div>
                <div class="code-editor">
                    <div class="code-line-numbers">
                        1<br>
                        2
                    </div>
                    <div class="code-text">
                        <code lang="php">
                            <span class="code-hl-variable">$jsonString</span> = <span class="code-hl-function">file_get_contents</span>(<span class="code-hl-string">"./data/kea-dhcp4.conf"</span>);<br>
                            <span class="code-hl-variable">$decodedJson</span> = <span class="code-hl-function">json_decode</span>(<span class="code-hl-variable">$jsonString</span>, <span class="code-hl-keyword">true</span>);
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>
</body>
</html>