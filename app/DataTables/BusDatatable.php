<?php

namespace App\DataTables;

use App\Models\Bus;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BusDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return dataTables()
            ->eloquent($query)
            ->addColumn('action',function($data){
                $id=$data->id;
                return '<a class="btn btn-light" href="' . url("Admin/editbus/". $id) . '"><i style="color:blue" class="fa fa-edit"></i></a>
                <a class="btn btn-light" href="' . url("Admin/deletebus/". $id) . '"><i style="color:red" class="fa fa-trash"></i></a>';
            })

            ->rawColumns(['action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Bus $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Bus $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('busdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bflrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('no')->data('DT_RowIndex')->searchable(false)->orderable(false)->width(50),
            Column::make('name')->title('BusName'),
            Column::make('no')->title('BusNo'),
            Column::make('source'),
            Column::make('destination'),
            Column::make('onward')->title('Date'),
            Column::make('time'),
            Column::make('seats'),
            Column::make('price'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Bus_' . date('YmdHis');
    }
}