/**
 * BLOCK: barrierefreie-bloecke/table
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks; 
const { RichText, BlockControls, AlignmentToolbar, InspectorControls } = wp.blockEditor;
const { Fragment } = wp.element;
const { Toolbar, DropdownMenu, PanelBody, MenuItem, MenuGroup, ToggleControl, Placeholder, Button, TextControl, ToolbarButton } = wp.components;
const{ times } = lodash;

registerBlockType( 'barrierefreie-bloecke/table', {
	title: __( 'Tabelle - Barrierefrei' ),
	icon: 'editor-table',
	category: 'common', 
	keywords: [
		__( 'Tabelle' ),
		__( 'Barrierefreiheit' ),
	],
	description: __('Block für Tabellen mit mehr Möglichkeiten, die der Barrierefreiheit gerecht werden.'),
	attributes:{
		fixedWidth:{
			type: 'boolean',
			default: false
		},
		headerRow:{
			type: 'boolean',
			default: false
		},
		footerRow:{
			type: 'boolean',
			default: false
		},
		rowCount:{
			type: 'number',
			default: '2'
		},
		colCount:{
			type: 'number',
			default: '2'
		},
		showPlaceholder:{
			type: 'boolean',
			default: true
		},
		caption:{
			type: 'string'
		},
		summary:{
			type: 'string'
		},
		selectedCellIndex:{
			type: 'number',
			default: '0'
		},
		selectedCellIndex2:{
			type: 'number',
			default: '0'
		},
		selectedCellAlignment:{
			type: 'string',
			default: 'left'
		},
		selectedCellTyp:{
			type: 'string',
			default: 'td'
		},
		selectedCellScope:{
			type: 'string',
			default: ''
		},
		table:{
			type: 'array',
			default: [
				{
					typ: 'tr',
					cells:[{
						typ: 'td',
						content:'hallo',
						alignment: 'left',
						scope: ''
					}
						]
					}
			],
		}
	},
	edit: ( {attributes, setAttributes} ) => {
		const { fixedWidth, headerRow, footerRow, rowCount, colCount, showPlaceholder, table, summary, caption, selectedCellIndex, selectedCellIndex2, selectedCellAlignment, selectedCellTyp, selectedCellScope } = attributes;
		const onChangeFixedWidth = (fixedWidth) =>{
			setAttributes({ fixedWidth })
		} 
		const onChangeSummary = (summary) =>{
			setAttributes({ summary })
		} 
		const onChangeCaption = (caption) =>{
			setAttributes({ caption })
		} 
		const onChangeHeaderRow = (headerRow) =>{
			setAttributes({ headerRow })
			if(headerRow){
				setAttributes({
					 table: [{
						typ: 'thead',
						cells: times(
							colCount, () => ({
								content:'',
								typ: 'th',
								alignment: 'center'
							})
						)
					}, ...table]
				})
			} else{
				setAttributes({table: table.filter((t) => t.typ !== 'thead')})
			}
		} 
		const onChangeFooterRow = (footerRow) =>{
			setAttributes({ footerRow })
			if(footerRow){
				setAttributes({
					 table: [...table, {
						typ: 'tfoot',
						cells: times(
							colCount, () => ({
								content:'',
								typ: 'td',
								alignment: 'left'
							})
						)
					}]
				})
			} else{
				setAttributes({table: table.filter((t) => t.typ !== 'tfoot')})
			}
		} 
		const onChangeRowCount = (rowCount) =>{
			setAttributes({ rowCount })
		} 
		const onChangeColCount = (colCount) =>{
			setAttributes({ colCount })
		} 
		const onSelectNewRow = (where) => {
			wp.data.dispatch( 'core/notices' ).createNotice(
				'warning', 
				__('Funktion zum Hinzufügen von neuer Zeilen noch nicht implementiert. Wir bitten um Entschuldigung!'), 
				{isDismissible: true}
		)
		}
		const onSelectNewCol = (where) => {
			wp.data.dispatch( 'core/notices' ).createNotice(
				'warning', 
				__('Funktion zum Hinzufügen von neuen Spalten noch nicht implementiert. Wir bitten um Entschuldigung!'), 
				{isDismissible: true}
		)
		}
		const onDeleteRow = () => {
			wp.data.dispatch( 'core/notices' ).createNotice(
				'warning', 
				__('Funktion zum Löschen von Spalten noch nicht implementiert. Wir bitten um Entschuldigung!'), 
				{isDismissible: true}
		)
		}
		const onDeleteCol = () => {
			wp.data.dispatch( 'core/notices' ).createNotice(
				'warning', 
				__('Funktion zum Löschen von Spalten noch nicht implementiert. Wir bitten um Entschuldigung!'), 
				{isDismissible: true}
		)
		}
		const onChangeCellData =(index, index2, v) =>{
			const newTable = [ ...table ];
  		newTable[index].cells[index2].content = v;
			setAttributes({ table: newTable })
		}
		const setSelectedCell =  () =>{
			setAttributes({selectedCellAlignment: table[selectedCellIndex].cells[selectedCellIndex2].alignment})
			setAttributes({selectedCellTyp: table[selectedCellIndex].cells[selectedCellIndex2].typ})
			setAttributes({selectedCellScope: table[selectedCellIndex].cells[selectedCellIndex2].scope})
		}
		const onChangeAlignment = (alignment) =>{
			const newTable = [ ...table ];
			newTable[selectedCellIndex].cells[selectedCellIndex2].alignment = alignment;
			setAttributes({ table: newTable })
		}
		const onChangeScope = (scope)=>{
			const newTable = [ ...table ];
			newTable[selectedCellIndex].cells[selectedCellIndex2].scope = scope;
			setAttributes({ table: newTable })
		}
		const onChangeCellType = ()=>{
			const newTable = [ ...table ]
			if(newTable[selectedCellIndex].cells[selectedCellIndex2].typ == 'td'){
				newTable[selectedCellIndex].cells[selectedCellIndex2].typ = 'th';
			} else{newTable[selectedCellIndex].cells[selectedCellIndex2].typ = 'td';}
			setAttributes({ table: newTable })
		}
		const initTable =()=>{
			// Anlegen der Tabelle mit angegebenen Anzahlen (Teil von F401)
			setAttributes({
				table: times(
					rowCount, () => ({
						typ: 'tr',
						cells: times(
							colCount, () => ({
								content:'',
								typ: 'td',
								alignment: 'left'
			}))}))})
		}
		const onShowTable = () =>{
			setAttributes({ showPlaceholder: false })
			initTable()
		} 
		const printTable = () => {
			// Ausgeben der Tabelle im Backend (F401) mit Ausgabe des RichText-Components für jede Zelle (F402, F412, F413, F416, F418)
			return (
				<table summary={ summary } class={fixedWidth ?'wp-block-barrierefreie-bloecke-table isFixedWidth' : 'wp-block-barrierefreie-bloecke-table'} > 
				<caption>{ caption }</caption>
				{ table.map((item, index) =>{
					if(item.typ == 'thead'){
						return (
							<thead><tr key={index}>
							{ item.cells.map((item2, index2)=>{
								return (
									<RichText width="100%"key={index2} id={index+"-"+index2} tagName={table[index].cells[index2].typ} value={item2.content} onChange={ (v) => onChangeCellData(index, index2, v) } unstableOnFocus={ () => {
										setAttributes({selectedCellIndex: index})
										setAttributes({selectedCellIndex2: index2}) 
										setSelectedCell(  )} }style={{textAlign: table[index].cells[index2].alignment}} scope={table[index].cells[index2].scope} />
							)})}
							</tr></thead>
						)
					}else if (item.typ == 'tfoot'){
						return (
							<tfoot><tr key={index}>
							{ item.cells.map((item2, index2)=>{
								return (
									<RichText width="100%"key={index2} id={index+"-"+index2} tagName={table[index].cells[index2].typ} onChange={ (v) => onChangeCellData(index, index2, v) } unstableOnFocus={ () => {
										setAttributes({selectedCellIndex: index})
										setAttributes({selectedCellIndex2: index2}) 
										setSelectedCell(  )} }style={{textAlign: table[index].cells[index2].alignment}} />
							)})}
							</tr></tfoot>
						)
					}else{
						return (
							<tr key={index}>
							{ item.cells.map((item2, index2)=>{
								return (
									<RichText width="100%"key={index2} id={index+"-"+index2} tagName={table[index].cells[index2].typ} value={item2.content} onChange={ (v) => onChangeCellData(index, index2, v) } unstableOnFocus={ () => {
										setAttributes({selectedCellIndex: index})
										setAttributes({selectedCellIndex2: index2}) 
										setSelectedCell(  )} } style={{textAlign: table[index].cells[index2].alignment}}>
									
									</RichText>
							)})}
							</tr>
					)}})}
				</table>
			) 
		}
		return (
			<Fragment>
				{showPlaceholder ?
				// Placeholder welches die Eingabe von Spalten- und Zeilen-Anazhl ermöglicht (F400)
					<Placeholder 
						icon='editor-table' 
						label={ __('Tabelle') } 
						instructions={ __('Füge eine Tabelle ein, um Daten zu teilen.') } >
						<TextControl
							value={ colCount }
							label={ __('Anzahl der Spalten') }
							onChange={(v) => onChangeColCount(v)} />
						<TextControl
							value={ rowCount }
							label={ __('Anzahl der Zeilen') }
							onChange={(v) => onChangeRowCount(v)}/>
						<Button 
							isPrimary 
							onClick={ onShowTable } >Tabelle erstellen</Button>
					</Placeholder>
				:
					<Fragment>
						{table &&  printTable()}
						{/* Einstellungen für die Anforderungen F406, F408, F410, F420 */}
						<InspectorControls>
							<PanelBody title={ __('Tabellen-Einstellungen')}>
								<ToggleControl
									label={ __('Tabellenzellen mit fester Breite') }
									checked={ fixedWidth }
									onChange={(v) => onChangeFixedWidth(v)} />
								<ToggleControl
									label={ __('Kopfzeile') }
									checked={ headerRow }
									onChange={(v) => onChangeHeaderRow(v)} />
								<ToggleControl
									label={ __('Fußzeile') }
									checked={ footerRow }
									onChange={(v) => onChangeFooterRow(v)} />
								<TextControl
									value={ summary }
									label={ __('Zusammenfassung der Tabelle:') }
									onChange={(v) => onChangeSummary(v)} />
								<TextControl
									value={ caption }
									label={ __('Beschreibung was die Tabelle darstelltt:') }
									onChange={(v) => onChangeCaption(v)} />
							</PanelBody>
						</InspectorControls>
						<BlockControls>
							<Fragment>
								<Toolbar>
									<DropdownMenu
										icon = 'grid-view'
										label = {__('Tabelle bearbeiten')} >
										{ ( { onClose } ) => (
											<Fragment>
												<MenuGroup>
													<MenuItem onClick = {() => onSelectNewRow('before')} icon="table-row-before">
														{ __('Zeile oben hinzufügen') }
													</MenuItem>
													<MenuItem onClick = {() => onSelectNewRow('after')} icon="table-row-after">
														{ __('Zeile unten hinzufügen') }
													</MenuItem>
													<MenuItem onClick = {() => onDeleteRow()} icon="table-row-delete">
														{ __('Zeile löschen') }
													</MenuItem>
													<MenuItem onClick = {() => onSelectNewCol('before')} icon="table-col-before">
														{ __('Spalte links hinzufügen') }
													</MenuItem>
													<MenuItem onClick = {() => onSelectNewCol('after')} icon="table-col-after">
														{ __('Spalte rechts hinzufügen') }
													</MenuItem>
													<MenuItem onClick = {() => onDeleteCol()} icon="table-col-delete">
														{ __('Spalte löschen') }
													</MenuItem>
												</MenuGroup>
											</Fragment>
										)}
									</DropdownMenu>
								</Toolbar>
								{/* Button zum Kennzeichnen einer TH-Zelle (F403) */}
								<Toolbar>
									<ToolbarButton
										icon={<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M10.6797 7.35938H7.02344V17.5H5.53125V7.35938H1.88281V6.125H10.6797V7.35938ZM21.1094 17.5H19.6016V12.2422H13.8672V17.5H12.3672V6.125H13.8672V11.0156H19.6016V6.125H21.1094V17.5Z" fill="currentColor"/>
										</svg>
										}
										label="Titelzelle setzen"
										onClick={ () => onChangeCellType() }
										isActive={table[selectedCellIndex].cells[selectedCellIndex2].typ == 'th'} />
								</Toolbar>
								{/* Einstellungsmöglichkeit für den Scope der ausgewählten Zelle (F404) */}
								{selectedCellTyp == 'th' &&
									<Toolbar>
										<DropdownMenu
											icon = 'move'
											label = {__('Scope ändern')} >
											{ ( { onClose } ) => (
												<Fragment>
													<MenuGroup>
														<MenuItem onClick = {() => onChangeScope('col')} icon='arrow-down-alt' isSelected={selectedCellScope == 'col'}>
															{ __('Spalte') }
														</MenuItem>
														<MenuItem onClick = {() => onChangeScope('row')} icon='arrow-right-alt' isSelected={selectedCellScope == 'col'}>
															{ __('Zeile') }
														</MenuItem>
														<MenuItem onClick = {() => onChangeScope('')} icon='no-alt' isSelected={selectedCellScope == 'col'}>
															{ __('Keiner') }
														</MenuItem>
													</MenuGroup>
												</Fragment>
											)}
										</DropdownMenu>
									</Toolbar>
								}
								{/* Einstellmöglichkeit für die Ausrichtung (F422) */}
								<AlignmentToolbar value = {selectedCellAlignment} onChange = {(v) => onChangeAlignment(v)} />
							</Fragment>
						</BlockControls>
					</Fragment>
				}
			</Fragment>
		);},
	save: ({ attributes }) => {
		const { fixedWidth, table, summary, caption } = attributes;
		return (
			<Fragment>
				{/* Ausgabe der Tabelle im Frontend zum erfüllen der Anforderungen F405, F407, F409, F411, F414, F415, F417, F419, F421, F423 */}
				{table &&
					<table summary={summary != "" && summary} class={fixedWidth ? "wp-block-barrierefreie-bloecke-table isFixedWidth" : "wp-block-barrierefreie-bloecke-table"}>
						{caption && <caption>{ caption }</caption>}
						<Fragment>
							{ table.map((item, index) =>{
								if(item.typ == 'thead'){
									return (
										<thead><tr key={index}>
										{ item.cells.map((item2, index2)=>{
											return (
												<RichText.Content width="100%" key={index2} tagName={table[index].cells[index2].typ} value={item2.content} style={{textAlign: table[index].cells[index2].alignment}} scope={table[index].cells[index2].scope} />
											)
										})}
										</tr></thead>
									)
								}else if (item.typ == 'tfoot'){
									return (
										<tfoot><tr key={index}>
										{ item.cells.map((item2, index2)=>{
											return (
												<RichText.Content width="100%"key={index2} tagName={table[index].cells[index2].typ} style={{textAlign: table[index].cells[index2].alignment}} scope={table[index].cells[index2].scope} />
											)
										})}
										</tr></tfoot>
									)
								}else{
									return (
										<tr key={index}>
										{ item.cells.map((item2, index2)=>{
											return (
												<RichText.Content width="100%"key={index2} tagName={table[index].cells[index2].typ} value={item2.content} style={{textAlign: table[index].cells[index2].alignment}} scope={table[index].cells[index2].scope} />						
											)
										})}
										</tr>
									)
								}
							})}
						</Fragment>
					</table>
				}
			</Fragment>
		);
	},
} );