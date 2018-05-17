<?php require_once('backend.php');?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body {
      padding-top: 5rem;
    }
    </style>
    <title>Coderbus GBP Readout</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark navbar- fixed-top bg-dark">
      <div class="container" id="navcontainer">
        <a class="navbar-brand" href="https://atlantaned.space/statbus/"> Back to Statbus </a>
      </div>
    </nav>
    <div class="container">
      <h1>PR Balance Data</h1>
      <hr>
      <p class="lead"><?php echo array_sum($gbp);?> points have been earned.</p>
      <div class="row">
        <div class="col-md-6">
          <div class="page-header">
            <h1>Coder Balances</h1>
          </div>
        <table class="table table-sm table-bordered sort">
          <thead>
            <tr>
              <th>Username</th>
              <th>Balance</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($gbp as $g => $n):?>
            <tr>
              <th>
                <a href='https://github.com/tgstation/tgstation/pulls?utf8=%E2%9C%93&q=is%3Apr%20author%3A<?php echo $g;?>' target="_blank" rel="noopener noreferrer">
                  <?php echo $g;?> <i class='fas fa-external-link-alt'></i>
                </a> 
              </th>
              <td><?php echo $n;?></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <div class="col-md-6">
        <div class="page-header">
          <h1>Repository Label Values</h1>
        </div>
        <table class="table table-sm table-bordered sort">
          <thead>
            <tr>
              <th>Label</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($labels as $label):?>
              <tr>
                <td>
                  <span class="badge gh-badge" style="background: #<?php echo $label->color;?>">
                      <a class="text-white" href="https://github.com/tgstation/tgstation/labels/<?php echo $label->name;?>" target="_blank" rel="noopener noreferrer"><?php echo $label->name;?>
                      </a>
                    </span>
                </td>
                <td>
                  <?php echo $label->value;?>
                </td>
              </tr>
              <?php endforeach;?>
              </tbody>
            </table>

            </div>
      </div>
    </div>
  </body>
</html>
