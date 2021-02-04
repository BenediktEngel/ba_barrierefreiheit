/**
 * BLOCK: barrierefreie-bloecke/Heading
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import './editor.scss';
import './style.scss';

const { __ } = wp.i18n; 
const { registerBlockType } = wp.blocks;

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
	edit: ( props ) => {
		return (
			<div className={ props.className }>
				<p>— Hello from the backend.</p>
				<p>
					CGB BLOCK: <code>barrierefreie-bloecke</code> is a new Gutenberg block
				</p>
				<p>
					It was created via{ ' ' }
					<code>
						<a href="https://github.com/ahmadawais/create-guten-block">
							create-guten-block
						</a>
					</code>.
				</p>
			</div>
		);
	},
	save: ( props ) => {
		return (
			<div className={ props.className }>
				<p>— Hello from the frontend.</p>
				<p>
					CGB BLOCK: <code>barrierefreie-bloecke</code> is a new Gutenberg block.
				</p>
				<p>
					It was created via{ ' ' }
					<code>
						<a href="https://github.com/ahmadawais/create-guten-block">
							create-guten-block
						</a>
					</code>.
				</p>
			</div>
		);
	},
} );
