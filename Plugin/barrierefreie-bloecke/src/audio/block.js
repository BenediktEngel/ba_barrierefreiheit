/**
 * BLOCK: barrierefreie-bloecke/Audio
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; 
const { registerBlockType } = wp.blocks; 

const { RichText, BlockControls, AlignmentToolbar, InspectorControls, MediaPlaceholder, MediaUpload, MediaUploadCheck } = wp.blockEditor;
const { Fragment } = wp.element;
const { Toolbar, PanelBody, ToggleControl, SelectControl, ToolbarButton, Spinner } = wp.components;
const {isBlobURL} = wp.blob;

registerBlockType( 'barrierefreie-bloecke/audio', {
	title: __( 'Audio - Barrierefrei' ), 
	icon: 'format-audio', 
	category: 'common',
	keywords: [
		__( 'audio' ),
		__( 'barrierefreiheit' ),
		__( 'musik' ),
	],
	description: __('Block für Audioinhalte mit der Möglichkeit für die Barrierefreiheit ein Audio-Transkript anzugeben.'),
	edit: ( {attributes, setAttributes} ) => {
		const { autoplay, repeat, preload, alignment, audioTranskript, url, id, mime, showTranskript } = attributes;
		const onChangeAutoplay = (autoplay) =>{
			setAttributes({ autoplay })
		}
		const onChangeRepeat = (repeat) =>{
			setAttributes({ repeat })
		}
		const onChangePreload = (preload) =>{
			setAttributes({ preload })
		}
		const onChangeAlignment = (alignment) =>{
			setAttributes({ alignment })
		}
		const onChangeAudioTranskript = (audioTranskript) =>{
			setAttributes({ audioTranskript })
		}
		const onSelectAudio = ({ url, id, mime }) =>{
			setAttributes({ url, id, mime })
		}
		const onChangeShowTranscript = () =>{
			setAttributes({showTranskript: !showTranskript})
		}
		const onError = (error) =>{
			wp.data.dispatch( 'core/notices' ).createNotice(
					'error', 
					error[2], 
					{isDismissible: true}
			);
		}
		return (
			<Fragment>
				{ url ?
					<Fragment>
						<div class="wp-block-barrierefreie-bloecke-audio-wrapper">
							<audio controls autoplay={autoplay} loop={repeat} preload={preload} class="wp-block-barrierefreie-bloecke-audio-el">
								<source src={ url } type={ mime } />
								{ __('Dein Browser unterstützt das Audio-Element nicht. Bitte update deinen Browser.') }
							</audio>
							{isBlobURL(url) &&
								<Spinner />
							}
							<button onClick={ onChangeShowTranscript }>
								{__('Audio-Transkript')}
								<span class="screen-reader-text">{__('anzeigen')}</span>
							</button>
						</div>
						{/* Angabe des Audiotranskripts, zur Erfüllung von F102, F103 */}
						<RichText 
							tagName = 'p'
							onChange = { onChangeAudioTranskript } 
							value = { audioTranskript }
							placeholder={ __( 'Hier Audio-Transkript eingeben (Text oder URL möglich)' ) }
							style = {{ textAlign: alignment, display:showTranskript ? 'block' : 'none' }}
						/>	
					</Fragment>
				:
				// Auswahl oder Hochladen der Audiodatei zur Erfüllung von F100 und F101
					<MediaPlaceholder 
						icon = "format-aside"
						labels = {
							{title: __('Audio'),
							instructions: __('Lade eine Audiodatei hoch oder wähle eine aus deiner Mediathek.')}}
						onSelect={(audio) => onSelectAudio(audio) }
						onError={(error) => onError(error) }
						accept='audio/*'
						allowedTypes={['audio']}
					/>
				}
				<InspectorControls>
					{url &&
					// Einstellungen zur Erfüllung von F108, F110, F113
						<PanelBody title={ __('Audio-Einstellungen')}>
							<ToggleControl
								label={ __('Autoplay') }
								checked={ autoplay }
								onChange={(v) => onChangeAutoplay(v)} 
							/>
							<ToggleControl
								label={ __('Schleife') }
								checked={ repeat }
								onChange={(v) => onChangeRepeat(v)} 
							/>
							<SelectControl
								label={ __('Vorladen') }
								value= { preload }
								options={ [
									{ label: __('Automatisch'), value: 'auto' },
									// { label: __('Browserstandard'), value: 'browser' },
									{ label: __('Metadaten'), value: 'metadata' },
									{ label: __('Keine'), value: 'none' },
								] }
								onChange={(v) => onChangePreload(v)}
							/>		
						</PanelBody>
					}
				</InspectorControls>
				{url &&
					<BlockControls>
						<Toolbar>
							<MediaUploadCheck>
								<MediaUpload
									onSelect={(audio) => onSelectAudio(audio)}
									allowedTypes={['audio']}
									value = { id }
									render={({open})=>{
										return (
											<ToolbarButton 
											label={ __('Audio ersetzen') }
											onClick={ open }
										>{ __('Audio ersetzen') }</ToolbarButton>
										)
									}}
								/>
							</MediaUploadCheck>	
						</Toolbar>
						<AlignmentToolbar 
							value = { alignment }
							onChange = {(v) => onChangeAlignment(v)}
						/>
					</BlockControls>
				}	
			</Fragment>
		);
	},
	save: ( {attributes} ) => {
		const {id, autoplay, repeat, preload, url, mime, audioTranskript, alignment} = attributes
		const newId = "audio"+ id 
		// Funktion welche beim Aktivieren des Buttons ausgeführt wird wenn das Transkript ein Text ist F105
		const toggleDescription = 
			"if(document.getElementById('"+ newId +"').style.display == 'none'){document.getElementById('"+newId +"').style.display = 'block'}else{document.getElementById('"+newId +"').style.display = 'none'}"
		// Prüfung ob URL übernommen von https://stackoverflow.com/a/43467144
		function isValidHttpUrl(string) {
			let url;
			try {
				url = new URL(string);
			} catch (_) {
				return false;  
			}
			return url.protocol === "http:" || url.protocol === "https:";
		}
		return (
			<Fragment>
				{url &&
					<Fragment>
						<div class="wp-block-barrierefreie-bloecke-audio-wrapper">
							{/* Ausgabe der Audiodatei für F109, F111, F112, F114 */}
							<audio controls autoplay={autoplay} loop={repeat} preload={preload} class={audioTranskript && 'wp-block-barrierefreie-bloecke-audio-el'}
							style={!audioTranskript && 'width:100%'}>
								<source src={ url } type={ mime } />
								{ __('Dein Browser unterstützt das Audio-Element nicht. Bitte update deinen Browser.') }
							</audio>
							{!isValidHttpUrl(audioTranskript) ?
								<Fragment>
									{audioTranskript &&
									// Button für F104, F106
										<button onClick={ toggleDescription } aria-hidden="true"focusable="false">
											{__('Audio-Transkript')}
										</button>
									}
								</Fragment>
							:
							// Verlinkung für F107, F106
								<a href={audioTranskript} aria-hidden="true" focusable="false" target="_blank" class="wp-block-file__button" style="margin-top: auto; margin-bottom: auto;"rel="noopener noreferrer">
									{__('Audio-Transkript')}
								</a>
							}
						</div>
						{!isValidHttpUrl(audioTranskript) &&
							<RichText.Content 
								tagName = 'p'
								value = { audioTranskript }
								style = {{ textAlign: alignment, display: 'none'}}
								id = { newId }
								aria-hidden="true"
							/>
						}
					</Fragment>
				}
			</Fragment>
		);
	},
} );