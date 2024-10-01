
<?php

use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use MagicObject\MagicObject;
use MagicObject\Request\InputGet;
use Sipro\Entity\Data\ProgresProyek;
use Sipro\Entity\Data\Proyek;
use Sipro\Util\DateUtil;

require_once dirname(__DIR__) . "/inc.app/auth-supervisor.php";

$template = '{
  "type": "line",
  "data": {
    "labels": ["January", "February", "March", "April", "May", "June", "July"],
    "datasets": [{
      "label": "Progres",
      "backgroundColor": "rgba(255,255,255,.55)",
      "borderColor": "rgba(180,180,180,.85)",
      "pointBackgroundColor": "coreui.Utils.getStyle(\'--cui-primary\')",
      "data": [65, 59, 84, 84, 51, 55, 40]
    }]
  },
  "options": {
    "plugins": {
      "legend": {
        "display": false
      }
    },
    "maintainAspectRatio": false,
    "scales": {
      "x": {
        "border": {
          "display": false
        },
        "grid": {
          "display": false,
          "drawBorder": false
        },
        "ticks": {
          "display": false
        }
      },
      "y": {
        "min": 0,
        "max": 100,
        "display": false,
        "grid": {
          "display": false
        },
        "ticks": {
          "display": false
        }
      }
    },
    "elements": {
      "line": {
        "borderWidth": 1,
        "tension": 0.4
      },
      "point": {
        "radius": 4,
        "hitRadius": 10,
        "hoverRadius": 4
      }
    }
  }
}
';


$config = [];
$config[0] = new MagicObject();
$config[1] = new MagicObject();
$config[2] = new MagicObject();
$config[3] = new MagicObject();

$config[0]->loadJsonString($template, false, true, true);
$config[1]->loadJsonString($template, false, true, true);
$config[2]->loadJsonString($template, false, true, true);
$config[3]->loadJsonString($template, false, true, true);
$inputGet = new InputGet();
if($inputGet->countableProyeks())
{
    $proyeks = $inputGet->getProyeks();
    $i = 0;
    foreach($proyeks as $proyekId)
    {
        
        $keys = [];
        $values = [];
        try
        {
            $progresProyeks = new ProgresProyek(null, $database);
            $specs = PicoSpecification::getInstance()
                ->addAnd(['proyekId', $proyekId])
            ;
            $sorts = PicoSortable::getInstance()
                ->addSortable(['waktuBuat', 'asc'])
            ;
            $pageData = $progresProyeks->findAll($specs, null, $sorts);
            $rows = $pageData->getResult();

            foreach($rows as $row)
            {
                $keys[] = DateUtil::translateDate($appLanguage, date('j M Y H:i', strtotime($row->getWaktuBuat())));
                $values[] = $row->getPersen();           
            }
        }
        catch(Exception $e)
        {
            $proyek = new Proyek(null, $database);
            $proyek->find($proyekId);
            $keys = [DateUtil::translateDate($appLanguage, date('j M Y H:i', strtotime($proyek->getWaktuUbah())))];
            $values = [$proyek->getPersen()];

        }
        $config[$i]->getData()->setLabels($keys);
        $config[$i]->getData()->getDatasets()[0]->setData($values);
        $i++;
    }
}
$result = [];

foreach($config as $conf)
{
    $result[] = $conf->value();
}
header("Content-type: application/json");
echo json_encode($result, JSON_PRETTY_PRINT);