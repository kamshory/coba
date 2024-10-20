<?php

use MagicApp\AppEntityLanguage;
use MagicApp\AppFormBuilder;
use MagicApp\Field;
use MagicObject\Database\PicoPredicate;
use MagicObject\Database\PicoSort;
use MagicObject\Database\PicoSortable;
use MagicObject\Database\PicoSpecification;
use MagicObject\Request\InputGet;
use Sipro\Entity\Data\JabatanMin;
use Sipro\Entity\Data\Supervisor;

$baseAssetsUrl = $appConfig->getSite()->getBaseUrl();

$appEntityLanguage = new AppEntityLanguage(new Supervisor(), $appConfig, 'id');
$inputGet = new InputGet();

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendors styles-->
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/simplebar/css/simplebar.css">
    <link rel="stylesheet" href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/vendors/simplebar.css">
    <!-- Main styles for this application-->
    <link href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/style.css" rel="stylesheet">
    <link href="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>css/custom.css" rel="stylesheet">
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>js/config.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelector('[type="password"]').addEventListener('keyup', function(e){
                let value = e.target.value;
                let regex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
                let valid = regex.test(value);
                if(valid && e.target.classList.contains('invalid-input'))
                {
                    e.target.classList.remove('invalid-input');
                }
                if(!valid)
                {
                    e.target.classList.add('invalid-input');
                }
            });
            document.querySelector('#captcha').addEventListener('click', function(e){
                e.preventDefault();
                e.stopImmediatePropagation();
                e.stopPropagation();
                let src = document.querySelector('#captcha').getAttribute('src');
                let arr = src.split('?');
                src = arr[0] + '?rand='+Math.random();
                e.target.setAttribute('src', src);
            });
        });
    </script>
  </head>
  <body>
    <div class="bg-body-tertiary min-vh-100 d-flex flex-row align-items-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <div class="card-group d-block d-md-flex row">
              <div class="card col-md-7 p-4 mb-0">
                <div class="card-body">
                  <?php
                  if($inputGet->getSuccess() == 1 || $inputGet->getSuccess() == 'true')
                  {
                    ?>
                    <h1><?php echo $appLanguage->getRegistrationSuccess();?></h1>
                    <p><?php echo $appLanguage->getMessageRegistrationSuccess();?></p>
                    <?php
                  }
                  else
                  {
                  ?>
                  <form action="" method="post">
                    <h1><?php echo $appLanguage->getRegistrationForm();?></h1>
                    <p class="text-body-secondary"><?php echo $appLanguage->getSelfServiceRegistrationFormForSupervisor();?></p>
                    <?php
                    if(isset($sessions->message))
                    {
                    ?>
                    <div class="alert alert-warning">
                        <?php
                        echo $sessions->message;
                        ?>
                    </div>
                    <?php
                    unset($sessions->message);
                    }
                    ?>
                    <table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td><?php echo $appEntityLanguage->getNip();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="text" name="nip" id="nip" value="<?php echo htmlspecialchars($inputPost->getNip());?>" />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getNamaDepan();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="text" name="nama_depan" id="nama_depan" required="required"/>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getNamaBelakang();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="text" name="nama_belakang" id="nama_belakang"/>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getKoordinator();?></td>
                                <td>
                                    <label><input class="form-check-input" type="checkbox" name="koordinator" id="koordinator" value="1" <?php echo $inputPost->getKoordinator() == 1 ? 'checked="checked"' : '';?> /> <?php echo $appEntityLanguage->getKoordinator();?></label>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getJabatan();?></td>
                                <td>
                                    <select class="form-control" name="jabatan_id" id="jabatan_id">
                                        <option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
                                        <?php echo AppFormBuilder::getInstance()->createSelectOption(new JabatanMin(null, $database),
                                        PicoSpecification::getInstance()
                                            ->addAnd(new PicoPredicate(Field::of()->aktif, true))
                                            ->addAnd(new PicoPredicate(Field::of()->draft, true)),
                                        PicoSortable::getInstance()
                                            ->add(new PicoSort(Field::of()->sortOrder, PicoSort::ORDER_TYPE_ASC))
                                            ->add(new PicoSort(Field::of()->nama, PicoSort::ORDER_TYPE_ASC)),
                                        Field::of()->jabatanId, Field::of()->nama, $inputPost->getJabatanId())
                                        ; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getJenisKelamin();?></td>
                                <td>
                                    <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option value=""><?php echo $appLanguage->getLabelOptionSelectOne();?></option>
                                        <option value="L" <?php echo AppFormBuilder::selected($inputPost->getJenisKelamin(), 'L');?>>Laki-Laki</option>
                                        <option value="P" <?php echo AppFormBuilder::selected($inputPost->getJenisKelamin(), 'P');?>>Perempuan</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getTempatLahir();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo htmlspecialchars($inputPost->getTempatLahir());?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getTanggalLahir();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo htmlspecialchars($inputPost->getTanggalLahir());?>" required />
                                </td>
                            </tr>
                            <tr>
						<td><?php echo $appEntityLanguage->getUkuranBaju();?></td>
						<td>
							<input autocomplete="off" class="form-control" type="text" name="ukuran_baju" id="ukuran_baju"/>
						</td>
                        </tr>
                        <tr>
                            <td><?php echo $appEntityLanguage->getUkuranSepatu();?></td>
                            <td>
                                <input autocomplete="off" class="form-control" type="text" name="ukuran_sepatu" id="ukuran_sepatu"/>
                            </td>
                        </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getEmail();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="email" name="email" id="email" value="<?php echo htmlspecialchars($inputPost->getEmail());?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getTelepon();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="tel" name="telepon" id="telepon" value="<?php echo htmlspecialchars($inputPost->getTelepon());?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getPassword();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="password" name="password" id="password" required />
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $appEntityLanguage->getCaptcha();?></td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="text" name="captcha" id="<?php echo $appEntityLanguage->getCaptcha();?>" required />
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <img src="<?php echo $baseAssetsUrl;?>lib.captcha/captcha-image.php" alt="" width="98" height="22" id="captcha"> <?php echo $appLanguage->getClickForReload();?>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="responsive responsive-two-cols" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="btn btn-success" name="user_action" value="create"><?php echo $appLanguage->getButtonRegister();?></button>
                                    <button type="button" class="btn btn-primary" onclick="window.location='./';"><?php echo $appLanguage->getButtonCancel();?></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                  </form>
                  <?php
                  }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
    <script src="<?php echo $baseAssetsUrl;?><?php echo $themePath;?>vendors/simplebar/js/simplebar.min.js"></script>
    <script>
      const header = document.querySelector('header.header');

      document.addEventListener('scroll', () => {
        if (header) {
          header.classList.toggle('shadow-sm', document.documentElement.scrollTop > 0);
        }
      });
    </script>
    <script>
    </script>

  </body>
</html>