<?php

namespace Epl\Sincronizador\Domain\Constants;

class Constant
{
    /** INICIO REGLAS DE NEGOCIO */
    const ARCHIVAR = 'ftp';
    const TODAS_TIENDAS = 'all';

    const TIENDA_WEB_DETAL = 'detal';
    const TIENDA_WEB_MAYOR = 'mayor';
    const ALMACEN_PRINCIPAL = 'matriz';
	const TIPO_ESPECIAL = array('fabrica', 'matriz');
	const EXCLUIR_TIENDAS = array('matriz', 'online', 'detal', 'mayor');

    const TODO = 1; /** Todas las opciones */
	const TODAS = 'all'; /** Todas las opciones */
	const ESPECIFICA = 2; /** Una opción especifica */
	const FABRICA = 'fabrica';
	const NO_PERMITIDA = 'La opción indicada para sincronizar con los almacenes no es permitida favor verifique'; /* 3 */
	const NO_TIENDA = 'No es una tienda VALLEVERDE favor verifique'; /* 4 */
	const TIPO_DESCONOCIDO = 'La opción es invalida, para proceder con la sincronización debe verficar el tipo. Valores Permitidos (wholesale, init_web, web, matriz, profit)';
    /** FIN REGLAS DE NEGOCIO */

    /** BEGIN V2 */
    const DIR_DREAMHOST = 'valleverde.tk/codigo/backend/storage/app/sync/';
    const DIR_AL_MAYOR  = 'valleverde.net.ve/al-mayor/Migrate/data/';
    const APP_SYNC      = 'app/sync/';
    /** END V2 */

   	const DATA_ZIP      = 'data.zip';
    const FILE          = 'app/sync/data.zip';
    const FILE_DIR      = 'app/sync/data';
    const FILE_DOWN     = 'down/data.zip';
    const FILE_DOWN_ZIP = 'app/sync/down/data.zip';
    const FILE_DIR_DOWN = 'app/sync/down/data';
    const DATA          = 'data/';

    const UP            = 'up/';
    const DOWN          = 'down/';
    const DOWN_DATA     = 'down/data/';

    /** INICIO: Constantes para sincronizar la tineda online */
    const BANKS         = 'banks.json';
    const BANK_ACCOUNTS = 'bank-accounts.json';
    const WAREHOUSE     = 'warehouse.json';
    const LINES         = 'lines.json';
    const SUB_LINES     = 'sub-lines.json';
    const COLORS        = 'colors.json';
    const SIZES         = 'sizes.json';
    const ARTICLES      = 'articles.json';
    const INVENTORIES   = 'inventories.json';
    const COIN          = 'coins.json';
    const PROMOTIONS    = 'promotions.json';
    const SALESMANS     = 'salesmans.json';
    const ORDER         = 'order.json';
    const QUOTE_BUDGET  = 'quote_budget.json';
    /** FIN: Constantes para sincronizar la tineda online */

    /** INICIO: Constantes para sincronizar la tineda online */
    const MAYOR_BANCOS          = 'bancos.xml';
    const MAYOR_CLIENTES        = 'clientes.xml';
    const MAYOR_COLORES         = 'colores.xml';
    const MAYOR_CUENTAS         = 'cuentas.xml';
    const MAYOR_DOCUM_CC        = 'docum_cc.xml';
    const MAYOR_LIN_ART         = 'lineas.xml';
    const MAYOR_COLORES_TALLAS  = 'sublinea_color.xml';
    const MAYOR_SUB_LIN         = 'sublineas.xml';
    const MAYOR_VENDEDOR        = 'vendedores.xml';
    /** FIN: Constantes para sincronizar la tineda online */


    /** INICIO: Constantes para sincronizacion entre tiendas tablas de profit */
    /** SUB-INICIO: Tablas dependientes */
    const TIPO_AJU        = 'tipo_aju.json';
    const CTA_INGR        = 'cta_ingr.json';
    const SEGMENTO        = 'segmento.json';
    const TIPO_PRO        = 'tipo_pro.json';
    const ZONA            = 'zona.json';
    const PROV            = 'prov.json';
    const TABULADO        = 'tabulado.json';
    const UNIDADES        = 'unidades.json';
    const PROCEDEN        = 'proceden.json';
    const TIPO_CLI        = 'tipo_cli.json';
    /** SUB-FIN:  Tablas dependientes */

    /** SUB-INICIO: Almacen y Sucursal */
    const ALMACEN         = 'almacen.json';
    const SUB_ALMA        = 'sub_alma.json';
    /** SUB-FIN:  Almacen y Sucursal */

    /** SUB-INICIO: Moneda */
    const MONEDA        = 'moneda.json';
    const TASAS         = 'tasas.json';
    /** SUB-FIN: Moneda */

    /** SUB-INICIO: Clientes */
    const VENDEDOR      = 'vendedor.json';
    const CLIENTES      = 'clientes.json';
    /** SUB-INICIO: Clientes */

    /** SUB-INICIO: Categorias */
    const LIN_ART       = 'lin-art.json';
    const SUB_LIN       = 'sub-lin.json';
    const COLORES       = 'colores.json';
    const CAT_ART       = 'cat-art.json';
    /** SUB-FIN: Categorias */

    /** SUB-INICIO: Inventario */
    const ART           = 'art.json';
    const LOTE          = 'lote.json';
    const ST_ALMAC      = 'st-alamc.json';
    const ST_LOTE       = 'st-lote.json';
    const AJUSTE        = 'ajuste.json';
    const RENG_AJU      = 'reng_aju.json';
    /** SUB-INICIO: Inventario */

    /** SUB-INICIO: Descuentos */
    const DESCUEN       = 'descuen.json';
    /** SUB-INICIO: Descuentos */

    /** SUB-INICIO: Traslado */
    const TRAS_ST_LOTE  = 'tras-st-lote.json';
    const TRAS_ST_ALMA  = 'tras-st-alma.json';
    const TRAS_LOTE     = 'tras-lote.json';
    const TRAS_ALMA     = 'tras-alm.json';
    const RENG_TRA      = 'reng-tra.json';
    /** SUB-INICIO: Traslado */

    /** SUB-INICIO: Facturas */
    const FACTURA       = 'factura.json';
    const RENG_FAC      = 'reng-fac.json';
    /** SUB-INICIO: Facturas */

    /** SUB-INICIO: Devoluciones */
    const DEV_CLI       = 'dev-cli.json';
    const RENG_DVC      = 'reng-dvc.json';
    /** SUB-INICIO: Devoluciones */

    /** SUB-INICIO: Cobros */
    const COBROS        = 'cobros.json';
    const RENG_COB      = 'reng-cob.json';
    const RENG_TIP      = 'reng-tip.json';
    /** SUB-INICIO: Cobros */

    /** SUB-INICIO: Documentos emitidos y anulados */
    const DOCUM_CC      = 'docum-cc.json';
    /** SUB-INICIO: Documentos emitidos y anulados */

    /** SUB-INICIO: Depositos */
    const CAJAS        = 'cajas.json';
    const CUENTAS      = 'cuentas.json';
    const DEP_CAJ      = 'dep-caj.json';
    const RENG_DP      = 'reng-dp.json';
    const MOV_CAJ      = 'mov-caj.json';
    const MOV_BAN      = 'mov-ban.json';
    /** SUB-INICIO: Depositos */
    /** FIN: Constantes para sincronizacion entre tiendas tablas de profit */
}