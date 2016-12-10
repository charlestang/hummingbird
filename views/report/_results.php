
<section class="table-responsive" style="overflow-x: scroll">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <?php foreach (reset($results) as $key => $val): ?>
                    <?php if (is_numeric($val)): ?>
                        <th><?php echo $key ?></th>
                    <?php else: ?>
                        <th><?php echo $key ?></th>
                    <?php endif ?>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <?php foreach ($row as $key => $val): ?>
                        <td><?php echo $val ?></td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</section>

