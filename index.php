<?php
session_start();

// 奖品数组（包括StatTrak™版本）
$blueItems = ['FN57涂鸦潦草', 'MAC-10坐牢', 'MAG-7先见之明', 'MP5-SD-小小噩梦', 'P2000-升天', 'SCAR-20-暗夜活死鸡', '截短霰弹枪-灵应牌'];
$blueItemsStatTrak = ['FN57涂鸦潦草(StatTrak™)', 'MAC-10坐牢(StatTrak™)', 'MAG-7先见之明(StatTrak™)', 'MP5-SD-小小噩梦(StatTrak™)', 'P2000-升天(StatTrak™)', 'SCAR-20-暗夜活死鸡(StatTrak™)', '截短霰弹枪-灵应牌(StatTrak™)'];

$purpleItems = ['PP-野牛-太空猫', 'G3SG1-梦之林地', 'M4A1消音-夜无眠', 'XM1014-行尸攻势', 'USP消音-地狱门票'];
$purpleItemsStatTrak = ['PP-野牛-太空猫(StatTrak™)', 'G3SG1-梦之林地(StatTrak™)', 'M4A1消音-夜无眠(StatTrak™)', 'XM1014-行尸攻势(StatTrak™)', 'USP消音-地狱门票(StatTrak™)'];

$pinkItems = ['双持贝瑞塔-瓜瓜', '法玛斯-目皆转晴', 'MP7-幽幻深渊'];
$pinkItemsStatTrak = ['双持贝瑞塔-瓜瓜(StatTrak™)', '法玛斯-目皆转晴(StatTrak™)', 'MP7-幽幻深渊(StatTrak™)'];

$redItems = ['AK47-夜愿', 'MP9-星使'];
$redItemsStatTrak = ['AK47-夜愿(StatTrak™)', 'MP9-星使(StatTrak™)'];

$goldItems = [
    '弯刀-传说', '弯刀-伽马多普勒', '弯刀-澄澈之水', '弯刀-自动化', '弯刀-自由之手', '弯刀-黑色层压板',
    '暗影双匕-黑色层压板', '暗影双匕-澄澈之水', '暗影双匕-自由之手', '暗影双匕-自动化', '暗影双匕-传说',
    '鲍伊猎刀-自由之手', '鲍伊猎刀-黑色层压板', '猎杀者匕首-黑色层压板', '猎杀者匕首-澄澈之水', '鲍伊猎刀-传说', 
    '鲍伊猎刀-自动化', '鲍伊猎刀-伽玛多普勒', '鲍伊猎刀-澄澈之水', '猎杀者匕首-自由之手', '猎杀者匕首-自动化', 
    '猎杀者匕首-传说', '暗影双匕-伽玛多普勒', '猎杀者匕首-伽玛多普勒', '蝴蝶刀-澄澈之水', '蝴蝶刀-自由之手', 
    '蝴蝶刀-传说', '蝴蝶刀-黑色层压板', '蝴蝶刀-自动化', '蝴蝶刀-伽玛多普勒'
];

$goldItemsStatTrak = [
    '弯刀-传说(StatTrak™)', '弯刀-伽马多普勒(StatTrak™)', '弯刀-澄澈之水(StatTrak™)', '弯刀-自动化(StatTrak™)', 
    '弯刀-自由之手(StatTrak™)', '弯刀-黑色层压板(StatTrak™)', '暗影双匕-黑色层压板(StatTrak™)', 
    '暗影双匕-澄澈之水(StatTrak™)', '暗影双匕-自由之手(StatTrak™)', '暗影双匕-自动化(StatTrak™)', 
    '暗影双匕-传说(StatTrak™)', '鲍伊猎刀-自由之手(StatTrak™)', '鲍伊猎刀-黑色层压板(StatTrak™)', 
    '猎杀者匕首-黑色层压板(StatTrak™)', '猎杀者匕首-澄澈之水(StatTrak™)', '鲍伊猎刀-传说(StatTrak™)', 
    '鲍伊猎刀-自动化(StatTrak™)', '鲍伊猎刀-伽玛多普勒(StatTrak™)', '鲍伊猎刀-澄澈之水(StatTrak™)', 
    '猎杀者匕首-自由之手(StatTrak™)', '猎杀者匕首-自动化(StatTrak™)', '猎杀者匕首-传说(StatTrak™)', 
    '暗影双匕-伽玛多普勒(StatTrak™)', '猎杀者匕首-伽玛多普勒(StatTrak™)', '蝴蝶刀-澄澈之水(StatTrak™)', 
    '蝴蝶刀-自由之手(StatTrak™)', '蝴蝶刀-传说(StatTrak™)', '蝴蝶刀-黑色层压板(StatTrak™)', 
    '蝴蝶刀-自动化(StatTrak™)', '蝴蝶刀-伽玛多普勒(StatTrak™)'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取开箱次数
    $drawCount = isset($_POST['drawCount']) ? intval($_POST['drawCount']) : 1;

    // 初始化统计数据
    $results = [
        'blue' => 0,
        'purple' => 0,
        'pink' => 0,
        'red' => 0,
        'gold' => 0
    ];
    $prizes = [
        'blue' => [],
        'purple' => [],
        'pink' => [],
        'red' => [],
        'gold' => []
    ];

    // 奖品类别
    $allItems = [
        'blue' => array_merge($blueItems, $blueItemsStatTrak),
        'purple' => array_merge($purpleItems, $purpleItemsStatTrak),
        'pink' => array_merge($pinkItems, $pinkItemsStatTrak),
        'red' => array_merge($redItems, $redItemsStatTrak),
        'gold' => array_merge($goldItems, $goldItemsStatTrak)
    ];

    // 模拟开箱
    for ($i = 0; $i < $drawCount; $i++) {
        $rand = mt_rand(1, 1000); // 生成1到1000之间的随机数

        if ($rand <= 799) { // 79.9% 概率抽到蓝色
            $prize = $allItems['blue'][array_rand($allItems['blue'])];
            $results['blue']++;
            $prizes['blue'][] = $prize;
        } elseif ($rand <= 959) { // 15.9% 概率抽到紫色
            $prize = $allItems['purple'][array_rand($allItems['purple'])];
            $results['purple']++;
            $prizes['purple'][] = $prize;
        } elseif ($rand <= 991) { // 3.2% 概率抽到粉色
            $prize = $allItems['pink'][array_rand($allItems['pink'])];
            $results['pink']++;
            $prizes['pink'][] = $prize;
        } elseif ($rand <= 997) { // 0.6% 概率抽到红色
            $prize = $allItems['red'][array_rand($allItems['red'])];
            $results['red']++;
            $prizes['red'][] = $prize;
        } else { // 0.25% 概率抽到金色
            $prize = $allItems['gold'][array_rand($allItems['gold'])];
            $results['gold']++;
            $prizes['gold'][] = $prize;
        }
    }

    // 限制蓝色、紫色和粉色奖品展示的个数
    $_SESSION['results'] = $results;
    $_SESSION['prizes'] = [
        'blue' => array_slice($prizes['blue'], 0, 10),  // 蓝色奖品限制为前10个
        'purple' => array_slice($prizes['purple'], 0, 10),  // 紫色奖品限制为前10个
        'pink' => array_slice($prizes['pink'], 0, 10),  // 粉色奖品限制为前10个
        'red' => $prizes['red'],  // 红色奖品不限制
        'gold' => $prizes['gold']  // 金色奖品不限制
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS:GO 模拟开箱</title>
    <link rel="stylesheet" href="styles.css">
</head>
    <div class="container">
        <h1>CS:GO 模拟开箱</h1>

        <form method="POST">
            <label for="drawCount">开箱次数：</label>
            <input type="number" id="drawCount" name="drawCount" min="1" value="1" max="1000">
            <button type="submit">开始开箱</button>
        </form>

        <h2>开箱结果</h2>
        <div class="results">
            <?php if (isset($_SESSION['results'])): ?>
                <p>蓝色奖品: <?php echo $_SESSION['results']['blue']; ?> 次</p>
                <p>紫色奖品: <?php echo $_SESSION['results']['purple']; ?> 次</p>
                <p>粉色奖品: <?php echo $_SESSION['results']['pink']; ?> 次</p>
                <p>红色奖品: <?php echo $_SESSION['results']['red']; ?> 次</p>
                <p>金色奖品: <?php echo $_SESSION['results']['gold']; ?> 次</p>

                <div class="prizes">
                    <div class="prize-type">
                        <strong>蓝色奖品：</strong>
                        <ul>
                            <?php foreach ($_SESSION['prizes']['blue'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="prize-type">
                        <strong>紫色奖品：</strong>
                        <ul>
                            <?php foreach ($_SESSION['prizes']['purple'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="prize-type">
                        <strong>粉色奖品：</strong>
                        <ul>
                            <?php foreach ($_SESSION['prizes']['pink'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="prize-type">
                        <strong>红色奖品：</strong>
                        <ul>
                            <?php foreach ($_SESSION['prizes']['red'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="prize-type">
                        <strong>金色奖品：</strong>
                        <ul>
                            <?php foreach ($_SESSION['prizes']['gold'] as $item): ?>
                                <li><?php echo $item; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
