<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Sushi\Sushi;
use Webmozart\Assert\Assert;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Modules\Tenant\Models\Traits\SushiToJson;

/**
 * Represents a table in the INFORMATION_SCHEMA.TABLES.
 * 
 * Provides metadata and statistics about database tables.
 *
 * @property string|null $TABLE_CATALOG
 * @property string|null $TABLE_SCHEMA
 * @property string|null $TABLE_NAME
 * @property string|null $TABLE_TYPE
 * @property string|null $ENGINE
 * @property int|null $VERSION
 * @property string|null $ROW_FORMAT
 * @property int|null $table_rows
 * @property int|null $AVG_ROW_LENGTH
 * @property int|null $DATA_LENGTH
 * @property int|null $MAX_DATA_LENGTH
 * @property int|null $INDEX_LENGTH
 * @property int|null $DATA_FREE
 * @property int|null $AUTO_INCREMENT
 * @property \Illuminate\Support\Carbon|null $CREATE_TIME
 * @property \Illuminate\Support\Carbon|null $UPDATE_TIME
 * @property \Illuminate\Support\Carbon|null $CHECK_TIME
 * @property string|null $TABLE_COLLATION
 * @property int|null $CHECKSUM
 * @property string|null $CREATE_OPTIONS
 * @property string|null $TABLE_COMMENT
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereAUTOINCREMENT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereAVGROWLENGTH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCHECKSUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCHECKTIME($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCREATEOPTIONS($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCREATETIME($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereDATAFREE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereDATALENGTH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereENGINE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereINDEXLENGTH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereMAXDATALENGTH($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereROWFORMAT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLECATALOG($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLECOLLATION($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLECOMMENT($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLENAME($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLEROWS($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLESCHEMA($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTABLETYPE($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereUPDATETIME($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereVERSION($value)
 * @property string|null $table_schema
 * @property string|null $table_name
 * @property string|null $updated_at
 * @property string|null $updated_by
 * @property string|null $created_at
 * @property string|null $created_by
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTableName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTableRows($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereTableSchema($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InformationSchemaTable whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class InformationSchemaTable extends Model
{
    use SushiToJson;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'table_schema',
        'table_name',
        'table_rows',
        
        'updated_at',
        'updated_by',
        'created_at',
        'created_by',
    ];

    /**
     * The schema for the Sushi model.
     *
     * @var array<string, string>
     */
    protected $schema = [
        'id' => 'integer',
        'table_schema' => 'string',
        'table_name' => 'string',
        'table_rows' => 'integer',
        'updated_at' => 'datetime',
        'updated_by' => 'string',
        'created_at' => 'datetime',
        'created_by' => 'string',
    ];

    
   
    /**
     * Get the rows array for the Sushi model.
     * This method is required by Sushi to provide the data.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getRows(): array
    {
        return $this->getSushiRows();
    }

    public static function updateModelCount(string $modelClass,int $total): void
    {
         if (! class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [$modelClass] does not exist");
        }

        /** @var Model $model */
        $model = app($modelClass);

        if (! $model instanceof Model) {
            throw new InvalidArgumentException("Class [$modelClass] must be an instance of ".Model::class);
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
        $driver = $connection->getDriverName();
        $table = $model->getTable();

        $row= InformationSchemaTable::updateOrCreate(['table_schema'=>$database,'table_name'=>$table],['table_rows'=>$total]);

    }
   

    /**
     * Get the row count for a model class.
     * This method incorporates the logic from CountAction.
     *
     * @param class-string<Model> $modelClass The fully qualified model class name
     *
     * @throws InvalidArgumentException If model class is invalid or not found
     */
    public static function getModelCount(string $modelClass): int
    {
        if (! class_exists($modelClass)) {
            throw new InvalidArgumentException("Model class [$modelClass] does not exist");
        }

        /** @var Model $model */
        $model = app($modelClass);

        if (! $model instanceof Model) {
            throw new InvalidArgumentException("Class [$modelClass] must be an instance of ".Model::class);
        }

        $connection = $model->getConnection();
        $database = $connection->getDatabaseName();
        $driver = $connection->getDriverName();
        $table = $model->getTable();

        
        $row= InformationSchemaTable::firstOrCreate(['table_schema'=>$database,'table_name'=>$table]);
        if($row->table_rows===null){
            $table_rows=$model->count();
            $row= tap($row)->update(['table_rows'=>$table_rows]);
        }
        
        return intval($row->table_rows);
        /*
        // Handle in-memory database
        if (':memory:' === $database) {
            return (int) $model->count();
        }

        // Handle SQLite specifically
        if ('sqlite' === $driver) {
            return (int) $model->count();
        }

        return $model->count();
        
        return static::getAccurateRowCount($table, $database);
        */
    }

   
}