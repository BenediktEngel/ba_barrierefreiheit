/**
 * BLOCK: barrierefreie-bloecke/Heading
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __, _x } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, BlockControls, AlignmentToolbar, InspectorControls, PanelColorSettings, ContrastChecker } = wp.blockEditor;
const { Fragment } = wp.element;
const { Toolbar, DropdownMenu, PanelBody, MenuItem, MenuGroup, FontSizePicker } = wp.components;

registerBlockType( 'barrierefreie-bloecke/heading', {
	title: __( 'Überschrift - Barrierefrei' ), 
	icon: 'heading', 
	category: 'common', 
	keywords: [
		__( 'Überschrift' ),
		__( 'Barrierefreiheit' ),
		__( 'Titel' ),
	],
	description: __('Block für Überschriften die es verhindern die Überschriftenhierarchie zu brechen, sodass die Barrierefreiheit gewährleistet werden kann.'),
	attributes: {
		content: {
				type: 'string',
		},
		alignment:{
			type: 'string'
		},
		tag:{
			type: 'string',
			default: '2'
		},
		backgroundColor:{
			type: 'string'
		},
		textColor:{
			type: 'string'
		},
		fontSize:{
			type: 'string',
		}
	},
	edit: ( {className, attributes, setAttributes } ) => {
		const { content, alignment, tag, backgroundColor, textColor, fontSize } = attributes;
		const fontSizes = [ 
			{ 
				name: _x( 'Small', 'font size name' ), 
				size: 13, 
				slug: 'small', 
			}, 
			{ 
				name: _x( 'Normal', 'font size name' ), 
				size: 16, 
				slug: 'normal', 
			}, 
			{ 
				name: _x( 'Medium', 'font size name' ), 
				size: 20, 
				slug: 'medium', 
			}, 
			{ 
				name: _x( 'Large', 'font size name' ), 
				size: 36, 
				slug: 'large', 
			}, 
			{ 
				name: _x( 'Huge', 'font size name' ), 
				size: 48, 
				slug: 'huge', 
			}, 
		];
		var newTag = 'h'.concat( tag );
		// Prüfung der bisherigen Überschriftsebenen F302
		var checkOtherHeadings = () => {
			const nrThis = wp.data.select('core/block-editor').getBlockInsertionPoint().index
			var lastTag = null
			var blocks = wp.data.select( 'core/block-editor' ).getBlocks()
			blocks.forEach(element => {
				if(blocks.indexOf(element) < nrThis-1 && element.attributes.tag){
					lastTag = element.attributes.tag
				}
			});
			if(lastTag == undefined){
				return 2;		
			}else{
				lastTag = Number(lastTag)+1
				return lastTag;
			}
		}
		const onChangeContent = (content) =>{
			setAttributes({ content })
		}
		const onChangeAlignment = (alignment) =>{
			setAttributes({ alignment })
		}
		const onChangeTag = (tag) =>{
			setAttributes({ tag })
			newTag = 'h'.concat({ tag })
		}
		const onChangeBackgroundColor = (backgroundColor) =>{
			setAttributes({ backgroundColor })
		}
		const onChangeTextColor = (textColor) =>{
			setAttributes({ textColor })
		}
		const onChangeFontSize = (fontSize) =>{
			setAttributes({ fontSize })
		}
		return (
			<Fragment>
				<InspectorControls>
					{/* Einstellung der Textgröße F313 */}
					<PanelBody title={ __('Typografie')}>
						<FontSizePicker 
							fontSizes={ fontSizes }
							value={ fontSize }
							fallbackFontSize= '16'
							onChange= {(v) => onChangeFontSize(v) }
						/>
					</PanelBody>
					{/* Einstellung der Textfarbe F311 */}
					<PanelColorSettings  
						title={ __('Farbeinstellungen')}
						colorSettings={[
							{
								value: textColor,
								onChange: onChangeTextColor,
								label: __('Textfarbe')
							},
							{
								value: backgroundColor,
								onChange: onChangeBackgroundColor,
								label: __('Hintergrundfarbe')
							}
						]}
					>
						<ContrastChecker
							fontSize={ 13 }
							textColor={ textColor}
							backgroundColor={ backgroundColor }
							fallbackTextColor = '#000'
							fallbackBackgroundColor = '#fff' 
						/>
					</PanelColorSettings>
				</InspectorControls>
				<BlockControls>
					{/* Einstellung der Überschriftsebene F301 */}
					<Toolbar>
						<DropdownMenu
							icon = 'heading'
							label = {__('Überschriftenebene ändern')} 
						>
							{ ( { onClose } ) => (
								<Fragment>
									<MenuGroup>
										<MenuItem onClick = {() => onChangeTag('2')}>
											H2
										</MenuItem>
										{checkOtherHeadings() > 2 &&
											<MenuItem onClick = {() => onChangeTag('3')}>
												H3
											</MenuItem>
										}
										{checkOtherHeadings() > 3 &&
											<MenuItem onClick = {() => onChangeTag('4')}>
												H4
											</MenuItem>
										}
										{checkOtherHeadings() > 4 &&
											<MenuItem onClick = {() => onChangeTag('5')}>
												H5
											</MenuItem>
										}
										{checkOtherHeadings() > 5 &&
											<MenuItem onClick = {() => onChangeTag('6')}>
												H6
											</MenuItem>
										}
									</MenuGroup>
								</Fragment>
							)}
						</DropdownMenu>			
					</Toolbar>
					{/* Einstellungen zur Ausrichtung F315 */}
					<AlignmentToolbar 
						value = { alignment }
						onChange = {(v) => onChangeAlignment(v)}
					/>
				</BlockControls>
				{/* Textfeld zur Eingabe der Überschrift F300 + F303, F304, F307, F309 */}
				<RichText 
					tagName = { newTag } 
					className = { className }
					onChange = { onChangeContent } 
					value = { content }
					placeholder={ __( 'Hier Überschrift eingeben...' ) }
					style = {{ textAlign: alignment, backgroundColor: backgroundColor, color: textColor, fontSize: fontSize+'px'}}
					multiline= 'false' 
				/>	
			</Fragment>			
		);
	},
	save: ( {className, attributes} ) => {
		const { content, alignment, tag, backgroundColor, textColor, fontSize } = attributes;
		const newTag = 'h'.concat(tag)
		return (
			// Ausgabe der Überschrift, welche Anforderung F305, F306, F308, F310, F312, F314, F316 entspricht
			<Fragment>
				{content &&
					<RichText.Content
						tagName = { newTag }
						className = { className }
						value = { content }
						style = {{ textAlign: alignment, backgroundColor: backgroundColor, color: textColor }}
					/>
				}
			</Fragment>
		);
	},
} );